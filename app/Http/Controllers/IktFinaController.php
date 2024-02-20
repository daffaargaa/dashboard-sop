<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Imports\IktImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class IktFinaController extends Controller
{
    public function index() {
        $data = [];
        $tokoTidakAktif = 0;

        return view('iktFina.index')->with([
            'data' => $data,
            'tokoTidakAktif' => $tokoTidakAktif,
        ]);
    }

    public function iktPreview(Request $request) {

        $ikt = Excel::toCollection(new IktImport(), $request->file('file_ikt'));
        $tanggal = $request->tanggal_target;
    
        $tmp = $ikt[0];

        $data = [];

        $tokoTidakAktif = 0;

        foreach ($tmp as $item) {
            $kd_store = $item['kd_store'];
            $query = DB::table('store')->where('kd_store', $kd_store)->get();

            $tmpArray = [
                'kd_store' => $kd_store,
                'nama_store' => $query[0]->nama_store,
                'status' => $query[0]->status,
                'net_sales' => $item['net_sales'],
                'net_profit' => $item['net_profit'],
                'rp_margin' => $item['rp_margin'],
                'prcn_margin' => $item['prcn_margin'],
                'musnah' => $item['musnah'],
                'product_loss' => $item['product_loss'],
            ];

            if ($tmpArray['status'] === 'T') {
                $data[] = $tmpArray;
            }
            else {
                $tokoTidakAktif++;
                continue;
            }
        }

        return view('iktFina.index')->with([
            'data' => $data,
            'tanggal' => $tanggal,
            'tokoTidakAktif' => $tokoTidakAktif,
        ]);
    }

    private function komaTrim($angka) {
        return (int) str_replace(',', '', $angka);
    }
    
    private function persenTrim($angka) {
        return (float) rtrim($angka, '%') / 100;
    }

    private function cekTanggal() {
        $tglTerakhir = Carbon::now()->endOfMonth()->subDays(3); // less than equals
        // $tanggalHariIni = Carbon::createFromFormat('Y-m-d', '2024-02-27'); // buat testing

        if (Carbon::now()->lte($tglTerakhir)) {
            // dd('bulan baru');
            return Carbon::now()->startOfMonth()->addMonth();   
        }
        else {
            // dd('current month');
            return Carbon::now()->startOfMonth();
        }
    }
                            
    public function iktStore(Request $request) {
    
        $data = json_decode($request->data, true);
        $tanggal = json_decode($request->tanggal, true);

        // $tanggalAwal = Carbon::parse($tanggal);
        // $tanggalAwal = $tanggalAwal->format('Y') . '-' . $tanggalAwal->format('m');

        // Cek apakah bulan target sudah ada di DB
        $cek = DB::table('tmp_target_ikt_store')->where('tgl_target', $this->cekTanggal())->count();
        
    
        if ($cek === 0) {
            for ($i = 0; $i < count($data); $i++) {
                DB::table('tmp_target_ikt_store')->insert([
                    'kd_store' => $data[$i]['kd_store'],
                    'tgl_target' => $this->cekTanggal(),
                    'net_sales' => $this->komaTrim($data[$i]['net_sales']),
                    'net_profit' => $this->komaTrim($data[$i]['net_sales']),
                    'rp_margin' => $this->komaTrim($data[$i]['rp_margin']),
                    'pct_margin' => $this->persenTrim($data[$i]['prcn_margin']),
                    'rp_musnah' => ($data[$i]['musnah'] / 100) *  $this->komaTrim($data[$i]['net_sales']),
                    'rp_product_loss' => ($data[$i]['product_loss'] / 100) * $this->komaTrim($data[$i]['net_sales']),
                    'tgl_proses' => Carbon::today(),
                    'user_id' => Auth::user()->nik, 
                ]);
    
                DB::table('rpt_ikt_net_profit')->insert([
                    'inp_store_code' => $data[$i]['kd_store'],
                    'inp_date' => $this->cekTanggal(),
                    'inp_net_sales_budget' => $this->komaTrim($data[$i]['net_sales']),
                    'inp_net_sales_opr' => $this->komaTrim($data[$i]['net_sales']),
                    'inp_net_profit_budget' => $this->komaTrim($data[$i]['net_sales']),
                    'inp_net_profit_opr' => $this->komaTrim($data[$i]['net_sales']),
                    'inp_gm_budget' => $this->komaTrim($data[$i]['rp_margin']),
                    'inp_gm_pct_budget' =>  $this->persenTrim($data[$i]['prcn_margin']),
                    'inp_shrinkage_budget' => ($data[$i]['musnah'] / 100) * $this->komaTrim($data[$i]['net_sales']),
                    'inp_nbh_budget' => ($data[$i]['product_loss'] / 100) * $this->komaTrim($data[$i]['net_sales'])
                ]);
            } 
            
            Alert::success('Sukses', 'Suksessss!');
            return redirect()->route('iktFina');
        }
        else {
            return view('iktFina.confirmation')->with(['data' => $data]);
        }
        

        // $data = [];
        // return view('iktFina.index')->with('data', $data);

    }

    // public function iktStoreConfirmation() {
    //     return view('confirmation');
    // }

    public function iktStoreAfterConfirmation(Request $request) {

        $data = json_decode($request->iktStore);

        $tanggal = $this->cekTanggal()->format('Y-m-d');

        $delete = DB::table('tmp_target_ikt_store')->where('tgl_target', $tanggal)->delete();
        
        for ($i = 0; $i < count($data); $i++) {
            DB::table('tmp_target_ikt_store')->insert([
                'kd_store' => $data[$i]->kd_store,
                'tgl_target' => $this->cekTanggal(),
                'net_sales' => $this->komaTrim($data[$i]->net_sales),
                'net_profit' => $this->komaTrim($data[$i]->net_sales),
                'rp_margin' => $this->komaTrim($data[$i]->rp_margin),
                'pct_margin' => $this->persenTrim($data[$i]->prcn_margin),
                'rp_musnah' => ($data[$i]->musnah / 100) *  $this->komaTrim($data[$i]->net_sales),
                'rp_product_loss' => ($data[$i]->product_loss / 100) * $this->komaTrim($data[$i]->net_sales),
                'tgl_proses' => Carbon::today(),
                'user_id' => Auth::user()->nik, 
            ]);

            DB::table('rpt_ikt_net_profit')->insert([
                'inp_store_code' => $data[$i]->kd_store,
                'inp_date' => $this->cekTanggal(),
                'inp_net_sales_budget' => $this->komaTrim($data[$i]->net_sales),
                'inp_net_sales_opr' => $this->komaTrim($data[$i]->net_sales),
                'inp_net_profit_budget' => $this->komaTrim($data[$i]->net_sales),
                'inp_net_profit_opr' => $this->komaTrim($data[$i]->net_sales),
                'inp_gm_budget' => $this->komaTrim($data[$i]->rp_margin),
                'inp_gm_pct_budget' =>  $this->persenTrim($data[$i]->prcn_margin),
                'inp_shrinkage_budget' => ($data[$i]->musnah / 100) * $this->komaTrim($data[$i]->net_sales),
                'inp_nbh_budget' => ($data[$i]->product_loss / 100) * $this->komaTrim($data[$i]->net_sales)
            ]);
        }

        $data = [];
        Alert::success('Sukses', 'Suksessss!');
        return redirect()->route('iktFina')->with('data', $data);
        // return view('iktFina.index')->with('data', $data);
        
    }
}

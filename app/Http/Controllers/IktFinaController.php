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
        return view('iktFina.index')->with('data', $data);
    }

    public function iktPreview(Request $request) {
        $ikt = Excel::toCollection(new IktImport(), $request->file('file_ikt'));
    
        $data = $ikt[0];

        return view('iktFina.index')->with('data', $data);
    }
                            
    public function iktStore(Request $request) {

        function komaTrim($angka) {
            return (int) str_replace(',', '', $angka);
        }
        
        function persenTrim($angka) {
            return (float) rtrim($angka, '%') / 100;
        }
    

        $data = json_decode($request->data, true);

        $tanggalAwal = Carbon::parse($request->tanggal_target);
        $tanggalAwal = $tanggalAwal->format('Y') . '-' . $tanggalAwal->format('m');

        for ($i = 0; $i < count($data); $i++) {
            DB::table('tmp_target_ikt_store')->insert([
                'kd_store' => $data[$i]['kd_store'],
                'tgl_target' => $request->tanggal_target,
                'net_sales' => komaTrim($data[$i]['net_sales']),
                'net_profit' => komaTrim($data[$i]['net_sales']),
                'rp_margin' => komaTrim($data[$i]['rp_margin']),
                'pct_margin' => persenTrim($data[$i]['prcn_margin']),
                'rp_musnah' => ($data[$i]['musnah'] / 100) *  komaTrim($data[$i]['net_sales']),
                'rp_product_loss' => ($data[$i]['product_loss'] / 100) * komaTrim($data[$i]['net_sales']),
                'tgl_proses' => Carbon::today(),
                'user_id' => Auth::user()->nik, 
            ]);

            DB::table('rpt_ikt_net_profit')->insert([
                'inp_store_code' => $data[$i]['kd_store'],
                'inp_date' => $tanggalAwal . '-01',
                'inp_net_sales_budget' => komaTrim($data[$i]['net_sales']),
                'inp_net_sales_opr' => komaTrim($data[$i]['net_sales']),
                'inp_net_profit_budget' => komaTrim($data[$i]['net_sales']),
                'inp_net_profit_opr' => komaTrim($data[$i]['net_sales']),
                'inp_gm_budget' => komaTrim($data[$i]['rp_margin']),
                'inp_gm_pct_budget' =>  persenTrim($data[$i]['prcn_margin']),
                'inp_shrinkage_budget' => ($data[$i]['musnah'] / 100) * komaTrim($data[$i]['net_sales']),
                'inp_nbh_budget' => ($data[$i]['product_loss'] / 100) * komaTrim($data[$i]['net_sales'])
            ]);

        }

        Alert::success('Sukses', 'Suksessss!');

        $data = [];
        // return view('iktFina.index')->with('data', $data);

        return redirect()->route('iktFina');
    }
}

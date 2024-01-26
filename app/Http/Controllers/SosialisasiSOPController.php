<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\PesertaImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SosialisasiSOPController extends Controller
{
    public function index() {
        $data['ms_sosialisasi'] = DB::table('sop_ms_sosialisasi')->get();
        
        $data['sop_sosialisasi'] = [];

        if (Auth::user()->dept == 'Internal Control') {
            $data['sop_sosialisasi'] = DB::table('sop_sosialisasi')->get();
        }
        else {
            $data['sop_sosialisasi'] = DB::table('sop_sosialisasi as a')
                                    ->join('sop_sosialisasi_user as b', 'a.id', '=', 'b.id_sosialisasi')
                                    ->where('b.nik_peserta', Auth::user()->nik)
                                    ->select('a.*', 'b.nik_peserta')
                                    ->get();
        }

        return view('sosialisasiSop.index', $data);
    }

    public function sosialisasiSopStore(Request $request) {
        // dd($request->all());

        try {
            $id_sosialisasi = DB::table('sop_sosialisasi')->insertGetId([
                'id_ms_sosialisasi' => $request->ms_sosialisasi,
                'nra' => $request->nra,
                'judul' => $request->judul,
                'tanggal_mulai' => $request->tgl_mulai,
                'tanggal_selesai' => $request->tgl_selesai,
                're_attempt_test' => $request->re_attempt_test,
                'limit_waktu_test' => $request->limit_waktu_test,
                'batas_nilai' => $request->grade_to_pass,
                'status' => '0',
                'user_id' => Auth::user()->nik,
            ]);

            // Insert User
            $user = Excel::toCollection(new PesertaImport(), $request->file('peserta'));
            
            foreach ($user[0] as $item) {
                $kd_toko = DB::table('users as a')->join('kode_toko_users as b', 'a.id', '=', 'b.id_user')
                            ->where('a.nik', $item[0])
                            ->select('b.kode_toko', 'a.nik')
                            ->first();

                DB::table('sop_sosialisasi_user')->insert([ 
                    'id_sosialisasi' => $id_sosialisasi,
                    'nik_peserta' => $item[0],
                    'kode_toko' => $kd_toko->kode_toko,
                    'status_lulus' => 'F',
                    'is_expired' => 'F',
                    'is_done' => 'F',
                ]);
            }

            return back()->with('input_success', 'Input berhasil!!');

        } catch (QueryException $e) {
            return back()->with('input_failed', 'Input gagal!!' . $e->getMessage());
        }
    }

    public function sosialisasiSopDetails($id_ms_sosialisasi) {
        $query = DB::table('sop_ms_sosialisasi')->where('id', $id_ms_sosialisasi)->first();
        $nra = str_replace('/', '_', $query->nra);

        $data = DB::table('sop_ms_sosialisasi_slides')
            ->where('id_ms_sosialisasi', $id_ms_sosialisasi)
            ->get();
        
        $slides = [];
        $ttv = [];

        foreach ($data as $item) {
            $slides[] = $item->slides;
            $ttv[] = $item->text_to_voice;
        }      
        
        return view('sosialisasiSop.details')->with([
            'nra' => $nra,
            'slides' => $slides,
            'ttv' => $ttv,
        ]);
    }
 }

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FPPController extends Controller
{
    public function index() {
        // Data untuk dropdown
        $data['users'] = DB::table('users')->get();

        $nik = Auth::user()->nik;

        $data['sop_fpp'] = DB::table('sop_fpp as a')
                            ->leftjoin('sop_fpp_form_approval as b', 'a.id', '=', 'b.id_sop_fpp')
                            ->where([['a.user_id', '=', $nik], ['a.status', '=', DB::raw('b.urutan')]])
                            ->orWhere('b.nik', '=', $nik)
                            ->get();

        return view('fppSop.index', $data);
        
    }

    public function indexApprovalStore(Request $request) {
        // Inputan atasan
        DB::table('approval')->insert([
            'nik' => $request->atasan,
            'urutan' => 1,
            'is_approve' => '0'
        ]);

        // Inputan SOP
        DB::table('approval')->insert([
            'nik' => $request->sop,
            'urutan' => 2,
            'is_approve' => '0'
        ]);

        return redirect()->route('indexApprovalFppSop');
    }
    
    public function fppSopStore(Request $request) {
        // Get format no_form
        $format = 'LWS/SP-FPPSOP/';
        $year = Carbon::today()->format('y');
        $month = Carbon::today()->format('m');
        // Hitung jumlah data
        $count = sprintf("%02d", DB::table('sop_fpp')->whereDate('created_at', Carbon::today())->count() + 1);
        // Susun ke bentuk utama
        $new_format = $format . $count . '/' . $month . '/' . $year;

        // Insert ke SOP_FPP (nama, inisial, dept, tipe_pengajuan)
        // get inisial
        $inisial = DB::table('users')->select('inisial')->where('name', $request->nama)->first();
        // ambil $id untuk ke table bawahnya
        $id = DB::table('sop_fpp')->insertGetId([
            'no_form' => $new_format,
            'nama' => $request->nama,
            'dept' => $request->dept,
            'tipe_pengajuan' => $request->tipe_pengajuan,
            'inisial' => $inisial->inisial,
            'status' => 1,
            'created_at' => Carbon::now(),
            'user_id' => Auth::user()->nik
        ]);

        // Insert ke table sop_fpp_form_approval - Atasan Pemilik
        DB::table('sop_fpp_form_approval')->insert([
            'id_sop_fpp' => $id,
            'nik' => $request->atasan_pemilik,
            'jenis' => 'Atasan Pemilik',
            'urutan' => 1,
            'is_approve' => 0,
            'created_at' => Carbon::now()
        ]);

        // Insert ke table sop_fpp_form_approval - Dept SOP
        DB::table('sop_fpp_form_approval')->insert([
            'id_sop_fpp' => $id,
            'nik' => $request->dept_sop,
            'jenis' => 'Dept SOP',
            'urutan' => 2,
            'is_approve' => 0,
            'created_at' => Carbon::now()
        ]);

        return back()->with('input_success', 'Data berhasil ditambahkan');
    }

    public function fppSopApprove($id, $nik, $isApprove) {
        // Coba implementasi Ternary
        $isApprove = $isApprove == 'approve' ? true : false;
        
        if ($isApprove) {
            $approver = DB::table('sop_fpp_form_approval')->where('id_sop_fpp', $id)->where('nik', $nik)->first();
    
            // Update is_approve di child untuk nik terkait terkait
            DB::table('sop_fpp_form_approval')->where('id_sop_fpp', $approver->id_sop_fpp)->where('nik', $approver->nik)->update([
                'is_approve' => 1,
                'updated_at' => Carbon::now(),
            ]);
    
            // Cari nik untuk approver berikutnya, ambil urutannya untuk set Status dari parent
            $nextApprover = DB::table('sop_fpp_form_approval')->where('id_sop_fpp', $id)->where('is_approve', '0')->first();
    
            if ($nextApprover) {
                DB::table('sop_fpp')->where('id', $id)->update([
                    'status' => $nextApprover->urutan,
                    'updated_at' => Carbon::now(),
                ]);
            }
            else {
                DB::table('sop_fpp')->where('id', $id)->update([
                    'status' => 'T',
                    'updated_at' => Carbon::now(),
                ]);
            }
        } 
        else { // proses reject
            $rejecter = DB::table('sop_fpp_form_approval')->where('id_sop_fpp', $id)->where('nik', $nik)->first();
    
            // Update is_approve di child untuk nik terkait terkait
            DB::table('sop_fpp_form_approval')->where('id_sop_fpp', $rejecter->id_sop_fpp)->where('nik', $rejecter->nik)->update([
                'is_approve' => 2,
                'updated_at' => Carbon::now(),
            ]);

            DB::table('sop_fpp')->where('id', $id)->update([
                'status' => 'F',
                'updated_at' => Carbon::now(),
            ]);
        }

        return back()->with('approve_success', 'Approve Berhasil!');
    }

    public function fppSopDetails($id_fpp) {
        $data['sop_fpp'] = DB::table('sop_fpp')->where('id', $id_fpp)->first();

        $data['sop_fpp_form_approval'] = DB::table('sop_fpp_form_approval as a')
                                        ->join('users as b', 'a.nik', '=', 'b.nik')
                                        ->where('id_sop_fpp', $id_fpp)
                                        ->select('a.jenis', 'a.is_approve', 'a.updated_at', 'b.inisial')
                                        ->get();

        return view('fppSop/details', $data);
    }

    public function fppSopExport($id_fpp) {
        $data['sop_fpp'] = DB::table('sop_fpp')->where('id', $id_fpp)->first();
        $data['sop_fpp_form_approval'] = DB::table('sop_fpp_form_approval as a')
                                        ->join('users as b', 'a.nik', '=', 'b.nik')
                                        ->where('id_sop_fpp', $id_fpp)
                                        ->select('a.jenis', 'a.is_approve', 'a.updated_at', 'b.inisial')
                                        ->get();

        $pdf = Pdf::loadView('fppSop.details', $data)->setPaper('A4', 'portrait');

        $format = DB::table('sop_fpp')->where('id', $id_fpp)->select('no_form')->first();
        return $pdf->download($format->no_form . '.pdf');
    }

    public function fppSopDestroy($id_fpp) {
        $destroy1 = DB::table('sop_fpp')->where('id', $id_fpp)->delete();
        $destroy2 = DB::table('sop_fpp_form_approval')->where('id_sop_fpp', $id_fpp)->delete();

        if ($destroy1 && $destroy2) {
            return back()->with('delete_success', 'Delete Berhasil!');
        }
        else {
            return back()->with('delete_failed', 'Delete gagal!');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArsipSOPController extends Controller
{
    public function index() {
        $data['ms_dept'] = DB::table('sop_arsip_ms_dept')->get();
        $data['list_of_depts'] = DB::table('sop_arsip_ms_dept as a')
                            ->leftJoin('sop_arsip as b', 'a.id', '=', 'b.id_dept')
                            ->select('a.dept',DB::raw('coalesce(count(b.id), 0) as jumlah'))
                            ->groupBy('a.dept', 'b.id')
                            ->get();
        // dd($data['list_of_depts']);
        $data['ms_produk'] = DB::table('sop_arsip_ms_produk')->get();
        $data['ms_jenis'] = DB::table('sop_arsip_ms_jenis')->get();

        return view('arsipSop.index', $data);
    }

    public function indexDept($dept) {
        $data['ms_dept'] = DB::table('sop_arsip_ms_dept')->get();
        $data['ms_produk'] = DB::table('sop_arsip_ms_produk')->get();
        $data['ms_jenis'] = DB::table('sop_arsip_ms_jenis')->get();
        $data['id_dept'] = DB::table('sop_arsip_ms_dept')->where('dept', $dept)->first();

        $data['sop_arsip'] = DB::table('sop_arsip as a')
                            ->join('sop_arsip_ms_produk as d', 'a.id_produk', '=', 'd.id')
                            ->select('a.id', 'a.nra', 'd.produk', 'a.keterangan', 'a.tgl_release', 'a.flag_opr')
                            ->where('a.id_dept', $data['id_dept']->id)
                            ->get();

        // $data['archive'] = DB::table('sop_arsip')->where('id_dept', )
        return view('arsipSop.index-dept', $data);
    }

    public function arsipSopNewArchiveStore(Request $request) {
        // dd($request->all());
        try {
            
            if(!$request->active) {
                $request->active = 'DISABLED';
            }

            $insert = DB::table('sop_arsip')->insert([
                'id_dept' => $request->dept,
                'id_jenis_arsip' => $request->jenis,
                'nra' => $request->nra,
                'id_produk' => $request->produk,
                'judul' => $request->judul,
                'keterangan' => $request->keterangan,
                'tgl_release' => $request->tgl_release,
                'file' => $request->file('file'),
                'flag_opr' => $request->active,
                'created_at' => Carbon::now(),
            ]);

            return back()->with('input_success', 'Input berhasil!!');
        }
        catch (Exception $e) {
            // // Tangkap dan tampilkan kesalahan saat insert
            // echo "Insert gagal: " . $e->getMessage();
            return back()->with('input_failed', 'Input gagal: ' . $e->getMessage());
        }
    }

    public function arsipSopMsDeptStore(Request $request) {

        try {
            if(!$request->active) {
                $request->active = 'DISABLED';
            }
    
            $insert = DB::table('sop_arsip_ms_dept')->insert([
                'dept' => $request->dept,
                'inisial_dept' => $request->inisial_dept,
                'status' => $request->active,
                'created_at' => Carbon::now(),
            ]);

            return back()->with('input_success', 'Input berhasil!!');
        }
        catch (Exception $e) {
            // // Tangkap dan tampilkan kesalahan saat insert
            // echo "Insert gagal: " . $e->getMessage();
            return back()->with('input_failed', 'Input gagal: ' . $e->getMessage());
        }
    }

    public function arsipSopMsProductStore(Request $request) {

        try {
            if(!$request->active) {
                $request->active = 'DISABLED';
            }
    
            $insert = DB::table('sop_arsip_ms_produk')->insert([
                'produk' => $request->produk,
                'inisial_produk' => $request->inisial_produk,
                'status' => $request->active,
                'created_at' => Carbon::now(),
            ]);

            return back()->with('input_success', 'Input berhasil!!');
        }
        catch (Exception $e) {
            // // Tangkap dan tampilkan kesalahan saat insert
            // echo "Insert gagal: " . $e->getMessage();
            return back()->with('input_failed', 'Input gagal: ' . $e->getMessage());
        }
    }

    public function arsipSopMsJenisStore(Request $request) {

        try {
            if(!$request->active) {
                $request->active = 'DISABLED';
            }
    
            $insert = DB::table('sop_arsip_ms_jenis')->insert([
                'jenis_arsip' => $request->jenis,
                'status' => $request->active,
                'created_at' => Carbon::now(),
            ]);

            return back()->with('input_success', 'Input berhasil!!');
        }
        catch (Exception $e) {
            // // Tangkap dan tampilkan kesalahan saat insert
            // echo "Insert gagal: " . $e->getMessage();
            return back()->with('input_failed', 'Input gagal: ' . $e->getMessage());
        }
    }


    public function arsipSopMsDeptDestroy($id) {
        try {
            $delete = DB::table('sop_arsip_ms_dept')->where('id', $id)->delete();
            
            return back();
        } catch (\Exception $e) {
            return back()->with('delete_failed', 'Delete gagal: ' . $e->getMessage());
        }
    }

    public function arsipSopMsProductDestroy($id) {
        try {
            $delete = DB::table('sop_arsip_ms_produk')->where('id', $id)->delete();
            
            return back();
        } catch (\Exception $e) {
            return back()->with('delete_failed', 'Delete gagal: ' . $e->getMessage());
        }
    }

    public function arsipSopMsJenisDestroy($id) {
        try {
            $delete = DB::table('sop_arsip_ms_jenis')->where('id', $id)->delete();
            
            return back();
        } catch (\Exception $e) {
            return back()->with('delete_failed', 'Delete gagal: ' . $e->getMessage());
        }
    }
}

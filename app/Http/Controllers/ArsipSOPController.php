<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArsipSOPController extends Controller
{
    public function index() {
        $data['ms_dept'] = DB::table('sop_arsip_ms_dept')->get();
        $data['list_of_depts'] = DB::table('sop_arsip_ms_dept as a')
                                ->leftJoin(DB::raw('(SELECT id_dept, COUNT(id) as jumlah FROM sop_arsip GROUP BY id_dept) as b'), 'a.id', '=', 'b.id_dept')
                                ->select('a.dept', DB::raw('COALESCE(b.jumlah, 0) as jumlah'))
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

        // Convert NRA / with _
        $nra = str_replace('/', '_', $request->nra);

        // Define the path for the new folder
        $path = 'public/arsipSop/' . $nra;

        // Create the folder per NRA that is inputted by the user
        Storage::makeDirectory($path);

        // Store file into the folder
        $pdf = $request->file('file');

        // first make the folder for the pdf and view to store the png
        Storage::makeDirectory($path . '/pdf');
        Storage::makeDirectory($path . '/view');
        
        // put the pdf into a folder and pdf into a folder
        if ($pdf) {
            Storage::putFileAs($path . '/pdf', $pdf, $nra . '.pdf');    
        }

        // Convert Start
        $dir = public_path('storage\arsipSop\\' . $nra . '\pdf\\' . $nra . '.pdf');
        $out = public_path('storage\arsipSop\\' . $nra . '\\' . 'view\\');

        $command = "magick -density 400 \"" . $dir . "\" -resize 800x -quality 100 \"" . $out . "-%d.png\"";
        exec($command, $output, $returnCode);        
        // Convert End 

        // Insert into DB
        try {
            
            if(!$request->active) {
                $request->active = 'DISABLED';
            }

            $id_arsip = DB::table('sop_arsip')->insertGetId([
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

            for ($i = 0; $i < count($request->dept_terkait); $i++) { 
                DB::table('sop_arsip_dept_terkait')->insert([
                    'id_dept' => $request->dept_terkait[$i],
                    'id_arsip' => $id_arsip,
                ]);
            } 

            return back()->with('input_success', 'Input berhasil!!');
        }
        catch (Exception $e) {
            // // Tangkap dan tampilkan kesalahan saat insert
            // echo "Insert gagal: " . $e->getMessage();
            return back()->with('input_failed', 'Input gagal: ' . $e->getMessage());
        }
    }

    public function arsipSopDownload ($nra) {
        $path = public_path('storage\arsipSop\\' . $nra . '\pdf\\' . $nra . '.pdf');
        return response()->download($path);
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

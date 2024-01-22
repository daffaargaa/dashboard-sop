<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KnowledgeSOPController extends Controller
{
    public function index() {
        $data['ms_sosialisasi'] = DB::table('sop_ms_sosialisasi')->get();
        $data['sop_knowledge'] = DB::table('sop_knowledge')->get();
        return view('knowledgeSop.index', $data);
    }

    public function knowledgeSopStore(Request $request) {
        try {
            DB::table('sop_knowledge')->insert([
                'id_sosialisasi' => $request->ms_sosialisasi,
                'nra' => $request->nra,
                'judul' => $request->judul,
                'tgl_efektif' => $request->tgl_efektif,
            ]);
            
            return back()->with('input_success', 'Input berhasil!!!');
            
        } catch (QueryException $e) {
            return back()->with('input_failed', 'Input gagal' . $e->getMessage());
        }

    }

    public function knowledgeSopDetails($nra) {
        
        return view('knowledgeSop.details')->with([
            'nra' => $nra,
        ]);
    }
}

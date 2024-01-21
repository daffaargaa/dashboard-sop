<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SOPbyDeptController extends Controller
{
    public function index() {
        $dept = Auth::user()->dept;

        $id_dept = DB::table('sop_arsip_ms_dept')->where('dept', $dept)->first();
        
        $data['sop_by_dept'] = DB::table('sop_arsip as a')->join('sop_arsip_dept_terkait as b', 'a.id', '=', 'b.id_arsip')
                                ->where('b.id_dept', $id_dept->id)
                                ->select('a.nra', 'a.judul', 'a.tgl_release', 'b.id_dept')
                                ->get();
        
        return view('sopByDept.index', $data);
    }
}

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

        
        return view('sopByDept.index');
    }
}

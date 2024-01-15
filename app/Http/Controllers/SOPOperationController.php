<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SOPOperationController extends Controller
{
    public function index() {
        $data['sop_opr'] = DB::table('sop_arsip')->where('flag_opr', 'ENABLED')->get();
        return view('sopOperation.index', $data);
    }
}

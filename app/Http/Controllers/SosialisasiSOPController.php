<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SosialisasiSOPController extends Controller
{
    public function index() {
        return view('sosialisasiSop.index');
    }
}

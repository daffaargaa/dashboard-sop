<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterSosialisasiController extends Controller
{
    public function index() {
        return view('masterSosialisasi.index');
    }
}

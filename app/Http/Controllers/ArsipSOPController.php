<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArsipSOPController extends Controller
{
    public function index() {
        return view('arsipSop.index');
    }

    public function arsipSopMsDeptStore(Request $request) {
        
    }
}

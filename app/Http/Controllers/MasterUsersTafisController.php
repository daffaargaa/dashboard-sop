<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterUsersTafisController extends Controller
{
    public function index() {
        return view('masterUsersTafis.index');
    }
}

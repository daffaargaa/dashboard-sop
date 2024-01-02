<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApprovalSOPController extends Controller
{
    public function index() {
        return view('approvalSop.index');
    }

    public function approvalSopStore(Request $request) {
        dd($request->all());
    }
}

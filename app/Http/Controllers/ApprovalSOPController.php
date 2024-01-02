<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ApprovalSOPController extends Controller
{
    public function index() {
        $data['sop_approval_draft'] = DB::table('sop_approval_draft')->get();
        return view('approvalSop.index', $data);
    }

    public function approvalSopStore(Request $request) {

        $file = $request->file('file_draft');

        if ($file) {
            $filename = $file->getClientOriginalName();
            Storage::putFileAs('public\approvalSop', $file, $filename);
        }

        $path = '\storage\approvalSop\\' . $file->getClientOriginalName();

        $input = DB::table('sop_approval_draft')->insert([
            'nra' => $request->nra,
            'judul' => $request->judul_produk,
            'file' => $path,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        if ($input) {
            return back()->with('input_success', 'Input berhasil!!');
        }
        else {
            return back()->with('input_failed', 'Input gagal!!');
        }
    }

    public function approvalSopDownload($id) {
        $path = DB::table('sop_approval_draft')->where('id', $id)->select('file')->first();
        return response()->file(public_path() . $path->file);
    }
}

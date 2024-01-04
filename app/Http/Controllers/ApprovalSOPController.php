<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ApprovalSOPController extends Controller
{
    public function index() {
        $data['sop_approval_draft'] = DB::table('sop_approval_draft')->get();
        return view('approvalSop.index', $data);
    }

    public function approvalSopStore(Request $request) {
        
        $file = $request->file('file_draft');
        $filename = $file->getClientOriginalName();
        $filenameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);

        if ($file) {
            Storage::putFileAs('public\approvalSop\\' . $filenameWithoutExt, $file, $filename);
        }

        $dir = public_path('storage\approvalSop\\' . $filenameWithoutExt . '\\' . $filename);
        $out = public_path('storage\approvalSop\\' . $filenameWithoutExt . '\\');
        $command = "magick -density 400 \"" . $dir . "\" -resize 800x -quality 100 \"" . $out . "-%d.png\"";
        exec($command, $output, $returnCode);

        // dd($returnCode);

        // Insert ke Database
        $input = DB::table('sop_approval_draft')->insert([
            'nra' => $request->nra,
            'judul' => $request->judul_produk,
            'file' => $filename,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        if (true) {
            return back()->with('input_success', 'Input berhasil!!');
        }
        else {
            return back()->with('input_failed', 'Input gagal!!');
        }
    }

    public function approvalSopDownload($id) {
        $path = DB::table('sop_approval_draft')->where('id', $id)->select('file')->first();
    
        return response()->file(public_path() . $path->file, $headers);
    }

    public function approvalSopDetails($id) {
        $data = DB::table('sop_approval_draft')->where('id', $id)->first();
        
        // Ambil nama folder
        $folder = pathinfo($data->file, PATHINFO_FILENAME);

        $folder = pathinfo($data->file, PATHINFO_FILENAME);
        $path = public_path('storage/approvalSop/' . $folder);
        $files = scandir($path);
        $files = array_diff($files, ['.', '..']);
        array_pop($files);

        // dd($files);
        
        return view('approvalSop.details')->with([
                'data' => $data,
                'files' => $files,
            ]);

    }
}

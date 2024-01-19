<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MasterSosialisasiController extends Controller
{
    public function index() {
        $data['ms_sosialisasi'] = DB::table('sop_ms_sosialisasi')->get();
        // dd($data['ms_sosialisasi']);
        return view('masterSosialisasi.index', $data);
    }

    public function masterSosialisasiStore (Request $request) {
        // dd($request->all());

        // Convert NRA - with _
        $nra = str_replace('/', '_', $request->nra);

        // Define the path for the new folder
        $path = 'public/masterSosialisasi/' . $nra;

        // Create the folder per NRA that is inputted by the user
        Storage::makeDirectory($path);

        // Store file into the folder
        $slides = $request->file('slides');
        $video = $request->file('video');

        // Convert Slides into PDF, first make the folder for the Slides to store the png
        Storage::makeDirectory($path . '/slides');
        Storage::makeDirectory($path . '/video');
        
        if ($slides && $video) {
            Storage::putFileAs($path, $slides, $slides->getClientOriginalName());
            Storage::putFileAs($path . '/video', $video, $video->getClientOriginalName());
        }

        // Convert Start
        $dir = public_path('storage\masterSosialisasi\\' . $nra . '\\' . $slides->getClientOriginalName());
        $out = public_path('storage\masterSosialisasi\\' . $nra . '\\' . 'slides\\');

        $command = "magick -density 400 \"" . $dir . "\" -resize 800x -quality 100 \"" . $out . "-%d.png\"";
        exec($command, $output, $returnCode);        
        // Convert End

        if(!$request->active) {
            $request->active = 'DISABLED';
        }

        // Insert into DB table SOP_MS_SOSIALISASI
        $idMsSosialisasi = DB::table('sop_ms_sosialisasi')->insertGetId([
            'nra' => $request->nra,
            'keterangan' => $request->keterangan,
            'file_video' => 'video/' . $video->getClientOriginalName(),
            'status' => $request->active,
        ]);

        // Insert into DB table SOP_MS_SOSIALISASI_SLIDES
        // Get the slides folder
        $slidesItem = scandir($out);
        $slidesItem = array_diff($slidesItem, ['.', '..']);
        
        foreach ($slidesItem as $item) {
            DB::table('sop_ms_sosialisasi_slides')->insert([
                'id_ms_sosialisasi' => $idMsSosialisasi,
                'slides' => $item,
                'text_to_voice' => 'halo assalamuaikum',
            ]);
        }
        
        return back()->with('input_success', 'Input berhasil!!!');
    }

    public function masterSosialisasiEdit($id) {
        dd('hallo' . $id);
    }
}

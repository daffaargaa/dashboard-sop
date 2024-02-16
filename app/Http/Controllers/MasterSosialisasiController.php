<?php

namespace App\Http\Controllers;

use App\Imports\TTVImport;
use App\Imports\TestImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class MasterSosialisasiController extends Controller
{
    public function index() {
        $data['ms_sosialisasi'] = DB::table('sop_ms_sosialisasi')->get();
        // dd($data['ms_sosialisasi']);
        return view('masterSosialisasi.index', $data);
    }

    public function masterSosialisasiStore (Request $request) {
        // dd($request->file('text_to_voice'));

        // Convert NRA - with _
        $nra = str_replace('/', '_', $request->nra);

        // Define the path for the new folder
        $path = 'public/masterSosialisasi/' . $nra;

        // Create the folder per NRA that is inputted by the user
        Storage::makeDirectory($path);

        // Store file into the folder
        $slides = $request->file('slides');
        $video = $request->file('video');

        // // Convert Slides into PDF, first make the folder for the Slides to store the png
        Storage::makeDirectory($path . '/slides');
        Storage::makeDirectory($path . '/video');
        
        if ($slides && $video) {
            Storage::putFileAs($path, $slides, $slides->getClientOriginalName());
            Storage::putFileAs($path . '/video', $video, $nra . '.mp4');
        }

        // Convert Start
        $dir = public_path('storage\masterSosialisasi\\' . $nra . '\\' . $slides->getClientOriginalName());
        $out = public_path('storage\masterSosialisasi\\' . $nra . '\\' . 'slides\\');

        $command = "magick -density 400 \"" . $dir . "\" -resize 800x -quality 100 \"" . $out . "-%d.png\"";
        exec($command, $output, $returnCode);        
        // // Convert End                                                                                                                               

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
        

        // Proses insert text_to_voice ke db
        $ttv = Excel::toCollection(new TTVImport(), $request->file('text_to_voice'));
        $ttv_files = [];

        foreach ($slidesItem as $index => $item) {

            DB::table('sop_ms_sosialisasi_slides')->insert([
                'id_ms_sosialisasi' => $idMsSosialisasi,
                'slides' => $item,
                'text_to_voice' => $ttv[0][$index][0],
            ]);
        }

        // Proses import soal ke db 
        $test = Excel::toCollection(new TestImport(), $request->file('soal'));

        // Insert pertanyaan ke tabel pertanyaan
        for ($i = 0; $i < $test[0]->count(); $i += 4) {
            $idPertanyaan = DB::table('sop_ms_sosialisasi_pertanyaan')->insertGetId([
                'id_ms_sosialisasi' => $idMsSosialisasi,
                'pertanyaan' => $test[0][$i][0],
            ]);

            // Insert jawaban dari pertanyaan
            for ($j = 0; $j < 4; $j++) {
                $index = $i + $j;
                DB::table('sop_ms_sosialisasi_jawaban')->insert([
                    'id_pertanyaan' => $idPertanyaan,
                    'jawaban' => $test[0][$index][1],
                    'jawaban_benar' => $test[0][$index][2],
                ]);
            }
        }
        return back()->with('input_success', 'Input berhasil!!!');
    }

    public function masterSosialisasiEdit(Request $request, $id) {
        // dd($request->all());
        try {

            if(!$request->active) {
                $request->active = 'Disabled';
            }

            DB::table('sop_ms_sosialisasi')->where('id', $id)->update([
                'nra' => $request->nra,
                'keterangan' => $request->keterangan,
                'status' => $request->active,
            ]);
            
            return back()->with('update_success', 'Update berhasil!!!');
            
        } catch (QueryException $e) {
            return back()->with('update_failed', 'Update gagal' . $e->getMessage());
        }
    }
}

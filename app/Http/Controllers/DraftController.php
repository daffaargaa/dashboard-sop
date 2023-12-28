<?php

namespace App\Http\Controllers;

use Imagick;
use ImagickDraw;
use ImagickPixel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DraftController extends Controller
{
    public function index() {
        $data['users'] = DB::table('users')->get();
        $data['urutan'] = DB::table('drafts')->get();
        return view('approvalSop.index', $data);
    }

    public function approveRendy() {
        $imagePath = public_path('sop/sop.png'); // Replace with your image path

        // Create an Imagick object
        $image = new Imagick($imagePath);

        // Create a drawing object
        $draw = new ImagickDraw();

        // Set font properties
        // $draw->setFont('path/to/your/font.ttf'); // Replace with your font file
        $draw->setFontSize(12);
        $draw->setFillColor(new ImagickPixel('#000000')); // Text color

        // Set text position
        $textX = 100; // FIXED
        $textY = 325;

        // Add text to the image
        $image->annotateImage($draw, $textX - 5, $textY, 0, 'Approved');
        $image->annotateImage($draw, $textX - 10, $textY + 20, 0, '13-DEC-23');
        // $image->annotateImage($draw, $textX + 20, $textY + 80, 0, 'Rendy');

        // Output the modified image
        $outputPath = public_path('sop/new_sop.png'); // Replace with the path to save the modified image
        $image->writeImage($outputPath);

        // if ($outputPath) {
        //     echo 'success';
        // } else {
        //     echo 'failed!';
        // }

        // Clear resources
        $image->clear();
        $image->destroy();

        return redirect()->route('indexDraft');
    }

    public function approveDede() {
        $imagePath = public_path('sop/new_sop.png'); // Replace with your image path

        // Create an Imagick object
        $image = new Imagick($imagePath);

        // Create a drawing object
        $draw = new ImagickDraw();

        // Set font properties
        // $draw->setFont('path/to/your/font.ttf'); // Replace with your font file
        $draw->setFontSize(12);
        $draw->setFillColor(new ImagickPixel('#000000')); // Text color

        // Set text position
        $textX = 175; // FIXED
        $textY = 325;

        // Add text to the image
        $image->annotateImage($draw, $textX - 5, $textY, 0, 'Approved');
        $image->annotateImage($draw, $textX - 10, $textY + 20, 0, '13-DEC-23');
        // $image->annotateImage($draw, $textX + 20, $textY + 80, 0, 'Rendy');

        // Output the modified image
        $outputPath = public_path('sop/new_sop.png'); // Replace with the path to save the modified image
        $image->writeImage($outputPath);

        // if ($outputPath) {
        //     echo 'success';
        // } else {
        //     echo 'failed!';
        // }

        // Clear resources
        $image->clear();
        $image->destroy();

        return redirect()->route('indexDraft');
    }
    
    public function approveMKA() {
        $imagePath = public_path('sop/new_sop.png'); // Replace with your image path

        // Create an Imagick object
        $image = new Imagick($imagePath);

        // Create a drawing object
        $draw = new ImagickDraw();

        // Set font properties
        // $draw->setFont('path/to/your/font.ttf'); // Replace with your font file
        $draw->setFontSize(12);
        $draw->setFillColor(new ImagickPixel('#000000')); // Text color

        // Set text position
        $textX = 245; // FIXED
        $textY = 325;

        // Add text to the image
        $image->annotateImage($draw, $textX - 5, $textY, 0, 'Approved');
        $image->annotateImage($draw, $textX - 10, $textY + 20, 0, '13-DEC-23');
        // $image->annotateImage($draw, $textX + 20, $textY + 80, 0, 'Rendy');

        // Output the modified image
        $outputPath = public_path('sop/new_sop.png'); // Replace with the path to save the modified image
        $image->writeImage($outputPath);

        // if ($outputPath) {
        //     echo 'success';
        // } else {
        //     echo 'failed!';
        // }

        // Clear resources
        $image->clear();
        $image->destroy();

        return redirect()->route('indexDraft');
    }

    public function approveKKARPA() {
        $imagePath = public_path('sop/new_sop.png'); // Replace with your image path

        // Create an Imagick object
        $image = new Imagick($imagePath);

        // Create a drawing object
        $draw = new ImagickDraw();

        // Set font properties
        // $draw->setFont('path/to/your/font.ttf'); // Replace with your font file
        $draw->setFontSize(12);
        $draw->setFillColor(new ImagickPixel('#000000')); // Text color

        // Set text position
        $textX = 590; // FIXED
        $textY = 965;

        // Add text to the image
        $image->annotateImage($draw, $textX - 5, $textY, 0, 'Approved');
        $image->annotateImage($draw, $textX - 10, $textY + 20, 0, '13-DEC-23');

        $image->annotateImage($draw, $textX + 75, $textY, 0, 'Approved');
        $image->annotateImage($draw, $textX + 70, $textY + 20, 0, '13-DEC-23');
        // $image->annotateImage($draw, $textX + 20, $textY + 80, 0, 'Rendy');

        // Output the modified image
        $outputPath = public_path('sop/new_sop.png'); // Replace with the path to save the modified image
        $image->writeImage($outputPath);

        // if ($outputPath) {
        //     echo 'success';
        // } else {
        //     echo 'failed!';
        // }

        // Clear resources
        $image->clear();
        $image->destroy();

        return redirect()->route('indexDraft');
    }

    public function approveKIA() {
        $imagePath = public_path('sop/new_sop.png'); // Replace with your image path

        // Create an Imagick object
        $image = new Imagick($imagePath);

        // Create a drawing object
        $draw = new ImagickDraw();

        // Set font properties
        // $draw->setFont('path/to/your/font.ttf'); // Replace with your font file
        $draw->setFontSize(12);
        $draw->setFillColor(new ImagickPixel('#000000')); // Text color

        // Set text position
        $textX = 490; // FIXED
        $textY = 325;

        // Add text to the image
        $image->annotateImage($draw, $textX - 5, $textY, 0, 'Approved');
        $image->annotateImage($draw, $textX - 10, $textY + 20, 0, '13-DEC-23');
        // $image->annotateImage($draw, $textX + 20, $textY + 80, 0, 'Rendy');

        // Output the modified image
        $outputPath = public_path('sop/new_sop.png'); // Replace with the path to save the modified image
        $image->writeImage($outputPath);

        // if ($outputPath) {
        //     echo 'success';
        // } else {
        //     echo 'failed!';
        // }

        // Clear resources
        $image->clear();
        $image->destroy();

        return redirect()->route('indexDraft');
    }


    public function testCompare() {
        $status = 1222;
        $approval = '1222';
        if ($approval == $status) {
            dd('bisa');
        } else {
            dd('gabisa');
        }
    }
}

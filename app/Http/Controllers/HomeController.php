<?php

namespace App\Http\Controllers;

use App\Charts\UserChart;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    public function index() {
        return view('home');
    }
}

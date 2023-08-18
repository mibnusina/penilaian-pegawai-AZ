<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class penilaianController extends Controller
{
    public function index() {
        return view('perhitungan.kriteria');
    }

}

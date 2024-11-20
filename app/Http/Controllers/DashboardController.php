<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model Data
        $data = Data::all();

        // Mengirim data ke view dashboard
        return view('dashboard.index', compact('data'));
    }
}



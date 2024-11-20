<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman Beranda
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Rute dengan Middleware 'auth'
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Data Management
    Route::prefix('data')->group(function () {
        Route::get('/', [DataController::class, 'index'])->name('data.index'); 
        Route::get('/create', [DataController::class, 'create'])->name('data.create'); 
        Route::post('/data/store', [DataController::class, 'store'])->name('data.store');
        Route::get('{id}/edit', [DataController::class, 'edit'])->name('data.edit'); 
        Route::put('{id}', [DataController::class, 'update'])->name('data.update'); 
        Route::delete('{id}', [DataController::class, 'destroy'])->name('data.destroy');
        Route::get('/data/search', [DataController::class, 'search'])->name('data.search');
    });
});

require __DIR__ . '/auth.php';


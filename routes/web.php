<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// group
// route group admin
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('petugas', [ProfileController::class, 'index'])->name('petugas.index');
    Route::post('petugas', [ProfileController::class, 'store'])->name('petugas.store');

    Route::get('ruangan', [RuanganController::class, 'index'])->name('ruangan.index');


    
});

// route group user
Route::middleware(['auth', 'verified'])->prefix('user')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard-user');
    })->name('dashboard.user');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/progress', [ProgressController::class, 'index'])->name('progress');
    Route::get('/progress/java', [ProgressController::class, 'java'])->name('progress.java');
    Route::get('/progress/python', [ProgressController::class, 'python'])->name('progress.python');
    Route::get('/progress/php', [ProgressController::class, 'php'])->name('progress.php');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/kategori/{slug}', [KategoriController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('kategori.show');
    
// Route Guru
Route::middleware(['auth', 'guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Guru\GuruDashboardController::class, 'index'])->name('dashboard');
    Route::get('/siswa', [App\Http\Controllers\Guru\GuruSiswaController::class, 'index'])->name('siswa');
});


require __DIR__.'/auth.php';
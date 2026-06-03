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

Route::get('/materi/{materi}', [KategoriController::class, 'baca'])
    ->middleware(['auth', 'verified'])
    ->name('materi.baca');
    
// Route Guru
Route::middleware(['auth', 'guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Guru\GuruDashboardController::class, 'index'])->name('dashboard');
    Route::get('/siswa', [App\Http\Controllers\Guru\GuruSiswaController::class, 'index'])->name('siswa');
    Route::get('/profile', [App\Http\Controllers\Guru\GuruProfileController::class, 'index'])->name('profile');
    //Materi
    Route::get('/materi', [App\Http\Controllers\Guru\GuruMateriController::class, 'index'])->name('materi');
    Route::post('/materi', [App\Http\Controllers\Guru\GuruMateriController::class, 'store'])->name('materi.store');
    Route::put('/materi/{materi}', [App\Http\Controllers\Guru\GuruMateriController::class, 'update'])->name('materi.update');
    Route::delete('/materi/{materi}', [App\Http\Controllers\Guru\GuruMateriController::class, 'destroy'])->name('materi.destroy');
    ///Quiz
    Route::get('/quiz', [App\Http\Controllers\Guru\GuruQuizController::class, 'index'])->name('quiz.index');
    Route::get('/quiz/create', [App\Http\Controllers\Guru\GuruQuizController::class, 'create'])->name('quiz.create');
    Route::post('/quiz', [App\Http\Controllers\Guru\GuruQuizController::class, 'store'])->name('quiz.store');
    Route::get('/quiz/{id}', [App\Http\Controllers\Guru\GuruQuizController::class, 'show'])->name('quiz.show');
    Route::get('/quiz/{id}/edit', [App\Http\Controllers\Guru\GuruQuizController::class, 'edit'])->name('quiz.edit');
    Route::put('/quiz/{id}', [App\Http\Controllers\Guru\GuruQuizController::class, 'update'])->name('quiz.update');
    Route::delete('/quiz/{id}', [App\Http\Controllers\Guru\GuruQuizController::class, 'destroy'])->name('quiz.destroy');
    Route::get('/quiz/{id}/hasil', [App\Http\Controllers\Guru\GuruQuizController::class, 'hasil'])->name('quiz.hasil');
    Route::get('/quiz/{id}/export', [App\Http\Controllers\Guru\GuruQuizController::class, 'export'])->name('quiz.export');

    // Soal
    Route::post('/soal', [App\Http\Controllers\Guru\GuruSoalController::class, 'store'])->name('soal.store');
    Route::put('/soal/{id}', [App\Http\Controllers\Guru\GuruSoalController::class, 'update'])->name('soal.update');
    Route::delete('/soal/{id}', [App\Http\Controllers\Guru\GuruSoalController::class, 'destroy'])->name('soal.destroy');
    });

    Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/quiz/{materi}', [App\Http\Controllers\QuizController::class, 'kerjakan'])->name('quiz.kerjakan');
    Route::post('/quiz/{materi}', [App\Http\Controllers\QuizController::class, 'submit'])->name('quiz.submit');
    });


require __DIR__.'/auth.php';
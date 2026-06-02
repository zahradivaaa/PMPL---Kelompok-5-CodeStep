<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentProgress;
use App\Models\Kategori;

class GuruSiswaController extends Controller
{
    public function index()
    {
        $siswa = User::where('role', 'siswa')->get();
        $kategoris = Kategori::with('materis')->get();

        // Hitung progress & nilai per siswa
        $siswa = $siswa->map(function ($s) use ($kategoris) {
            $totalMateri = $kategoris->sum(fn($k) => $k->materis->count());
            
            $progresses = StudentProgress::where('user_id', $s->id)->get();
            $dibaca = $progresses->where('materi_dibaca', true)->count();
            $quizSelesai = $progresses->where('quiz_selesai', true)->count();
            $nilaiList = $progresses->whereNotNull('nilai_quiz')->pluck('nilai_quiz');

            $s->total_progress = $totalMateri > 0
                ? round((($dibaca + $quizSelesai) / ($totalMateri * 2)) * 100)
                : 0;

            $s->avg_nilai = $nilaiList->count() > 0
                ? round($nilaiList->avg())
                : 0;

            return $s;
        });

        return view('guru.siswa', compact('siswa'));
    }
}
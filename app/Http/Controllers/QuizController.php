<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Soal;
use App\Models\HasilQuiz;
use App\Models\Materi;
use App\Models\StudentProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function kerjakan($materiId)
    {
        $user   = Auth::user();
        $materi = Materi::findOrFail($materiId);

        // Cek apakah materi sudah dibaca
        $progress = StudentProgress::where('user_id', $user->id)
            ->where('materi_id', $materi->id)
            ->first();

        if (!$progress || !$progress->materi_dibaca) {
            return redirect()->route('kategori.show', $materi->kategori->slug)
                ->with('error', 'Baca materi terlebih dahulu!');
        }

        // Ambil quiz untuk materi ini
        $quiz = Quiz::where('materi_id', $materi->id)->with('soals')->first();

        if (!$quiz) {
            return redirect()->route('kategori.show', $materi->kategori->slug)
                ->with('info', 'Belum ada quiz untuk materi ini.');
        }

        // Cek apakah sudah pernah mengerjakan
        $sudahKerjakan = HasilQuiz::where('quiz_id', $quiz->id)
            ->where('user_id', $user->id)
            ->first();

        if ($sudahKerjakan) {
            return redirect()->route('kategori.show', $materi->kategori->slug)
                ->with('info', "Kamu sudah mengerjakan quiz ini. Nilai: {$sudahKerjakan->nilai}/100");
        }

        $soals = $quiz->soals;

        if ($soals->isEmpty()) {
            return redirect()->route('kategori.show', $materi->kategori->slug)
                ->with('info', 'Belum ada soal untuk quiz ini.');
        }

        return view('quiz.kerjakan', compact('materi', 'quiz', 'soals'));
    }

    public function submit(Request $request, $materiId)
    {
        $user   = Auth::user();
        $materi = Materi::findOrFail($materiId);
        $quiz   = Quiz::where('materi_id', $materi->id)->with('soals')->firstOrFail();
        $soals  = $quiz->soals;

        $benar = 0;
        $totalPoin = 0;

        foreach ($soals as $soal) {
            $jawaban = $request->input('jawaban_' . $soal->id);
            if ($jawaban === $soal->jawaban_benar) {
                $benar++;
                $totalPoin += $soal->poin;
            }
        }

        $maxPoin = $soals->sum('poin');
        $nilai   = $maxPoin > 0 ? round(($totalPoin / $maxPoin) * 100) : 0;

        // Simpan hasil quiz
        HasilQuiz::updateOrCreate(
    ['quiz_id' => $quiz->id, 'user_id' => $user->id],
    [
        'nilai'         => $nilai,
        'jumlah_benar'  => $benar,
        'jumlah_salah'  => $soals->count() - $benar,
        'waktu_selesai' => now(),
    ]
);

        // Update student progress
        StudentProgress::updateOrCreate(
            ['user_id' => $user->id, 'materi_id' => $materi->id],
            [
                'materi_dibaca' => true,
                'quiz_selesai'  => true,
                'nilai_quiz'    => $nilai,
            ]
        );

        return redirect()->route('kategori.show', $materi->kategori->slug)
            ->with('success', "Quiz selesai! Nilai kamu: {$nilai}/100 ({$benar}/{$soals->count()} benar)");
    }
}
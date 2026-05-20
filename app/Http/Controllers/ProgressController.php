<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $progress = [
            ['lang' => 'Java',   'pct' => 30, 'color' => '#3B82F6'],
            ['lang' => 'Phyton', 'pct' => 45, 'color' => '#F59E0B'],
            ['lang' => 'PHP',    'pct' => 25, 'color' => '#22C55E'],
        ];

        $totalPct       = collect($progress)->avg('pct');
        $totalPelajaran = 2;
        $totalQuiz      = 2;
        $avgNilai       = '89,7';

        return view('progress', compact(
            'user', 'progress', 'totalPct',
            'totalPelajaran', 'totalQuiz', 'avgNilai'
        ));
    }

    public function java()
    {
        $user = Auth::user();

        $data = [
            'lang'      => 'Java',
            'color'     => '#3B82F6',
            'icon'      => 'java.png',
            'pct'       => 30,
            'kemajuan'  => 30,
            'pelajaran' => ['pct' => 40, 'label' => 'Pelajaran'],
            'quiz'      => ['pct' => 25, 'label' => 'Quiz'],
            'nilai'     => ['pct' => 60, 'label' => 'Nilai'],
        ];

        return view('progress-detail', compact('user', 'data'));
    }

    public function python()
    {
        $user = Auth::user();

        $data = [
            'lang'      => 'Phyton',
            'color'     => '#F59E0B',
            'icon'      => 'phyton.png',
            'pct'       => 45,
            'kemajuan'  => 45,
            'pelajaran' => ['pct' => 50, 'label' => 'Pelajaran'],
            'quiz'      => ['pct' => 30, 'label' => 'Quiz'],
            'nilai'     => ['pct' => 70, 'label' => 'Nilai'],
        ];

        return view('progress-detail', compact('user', 'data'));
    }

    public function php()
    {
        $user = Auth::user();

        $data = [
            'lang'      => 'PHP',
            'color'     => '#22C55E',
            'icon'      => 'php.png',
            'pct'       => 25,
            'kemajuan'  => 25,
            'pelajaran' => ['pct' => 20, 'label' => 'Pelajaran'],
            'quiz'      => ['pct' => 15, 'label' => 'Quiz'],
            'nilai'     => ['pct' => 50, 'label' => 'Nilai'],
        ];

        return view('progress-detail', compact('user', 'data'));
    }
}
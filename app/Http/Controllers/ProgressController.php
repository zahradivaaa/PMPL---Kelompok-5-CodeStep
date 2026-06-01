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
            'kemajuan'  => 30,
            'pelajaran' => ['pct' => 40, 'done' => 3,  'total' => 8],
            'quiz'      => ['pct' => 25, 'done' => 1,  'total' => 5],
            'nilai'     => ['pct' => 60, 'score' => 60, 'max'  => 100],
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
            'kemajuan'  => 45,
            'pelajaran' => ['pct' => 50, 'done' => 4,  'total' => 8],
            'quiz'      => ['pct' => 30, 'done' => 2,  'total' => 5],
            'nilai'     => ['pct' => 70, 'score' => 70, 'max'  => 100],
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
            'kemajuan'  => 25,
            'pelajaran' => ['pct' => 20, 'done' => 2,  'total' => 8],
            'quiz'      => ['pct' => 15, 'done' => 1,  'total' => 5],
            'nilai'     => ['pct' => 50, 'score' => 50, 'max'  => 100],
        ];

        return view('progress-detail', compact('user', 'data'));
    }
}
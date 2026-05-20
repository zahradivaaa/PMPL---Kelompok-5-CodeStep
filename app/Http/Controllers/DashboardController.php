<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ── Streak logic ──
        $today = Carbon::today();
        $lastVisit = $user->last_visit ? Carbon::parse($user->last_visit) : null;

        if (!$lastVisit || $lastVisit->lt($today)) {
            if ($lastVisit && $lastVisit->diffInDays($today) === 1) {
                // Kunjungan hari berikutnya → streak naik
                $user->streak = $user->streak + 1;
            } elseif (!$lastVisit || $lastVisit->diffInDays($today) > 1) {
                // Lebih dari 1 hari tidak akses → reset streak
                $user->streak = 1;
            }
            $user->last_visit = $today;
            $user->save();
        }

        // ── Weekly visits (S M T W T F S) ──
        $weekly = $user->weekly_visits ?? [];

        // Reset weekly setiap awal minggu (Senin)
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        if (empty($weekly) || !isset($weekly['week_start']) || $weekly['week_start'] !== $startOfWeek->toDateString()) {
            $weekly = [
                'week_start' => $startOfWeek->toDateString(),
                'days'       => [false, false, false, false, false, false, false],
            ];
        }

        // Tandai hari ini
        $dayIndex = Carbon::now()->dayOfWeek; // 0=Sun, 1=Mon, ..., 6=Sat
        $weekly['days'][$dayIndex] = true;
        $user->weekly_visits = $weekly;
        $user->save();

        // ── Progress (dummy, nanti bisa dari DB) ──
        // 0 = belum ada progress sama sekali
        $progress = [
            ['lang' => 'Java',   'pct' => 0, 'color' => '#3B82F6'],
            ['lang' => 'Python', 'pct' => 0, 'color' => '#F59E0B'],
            ['lang' => 'PHP',    'pct' => 0, 'color' => '#22C55E'],
        ];

        $totalPct = collect($progress)->avg('pct');

        return view('dashboard', compact('user', 'progress', 'totalPct', 'weekly'));
    }
}
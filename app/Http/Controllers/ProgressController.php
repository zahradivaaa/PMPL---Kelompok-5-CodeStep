<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\StudentProgress;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        $user      = Auth::user();
        $kategoris = Kategori::with('materis')->get();

        $progress       = [];
        $totalPelajaran = 0;
        $totalQuiz      = 0;
        $totalNilai     = [];

        foreach ($kategoris as $kategori) {
            $materiIds    = $kategori->materis->pluck('id');
            $jumlahMateri = $materiIds->count();

            if ($jumlahMateri === 0) {
                $progress[] = [
                    'lang'  => $kategori->nama,
                    'slug'  => $kategori->slug,
                    'pct'   => 0,
                    'color' => $this->warna($kategori->slug),
                    'icon'  => $kategori->icon,
                ];
                continue;
            }

            $progresses = StudentProgress::where('user_id', $user->id)
                ->whereIn('materi_id', $materiIds)
                ->get();

            $dibaca      = $progresses->where('materi_dibaca', true)->count();
            $quizSelesai = $progresses->where('quiz_selesai', true)->count();
            $nilaiList   = $progresses->whereNotNull('nilai_quiz')->pluck('nilai_quiz');

            $pct = round((($dibaca + $quizSelesai) / ($jumlahMateri * 2)) * 100);

            $totalPelajaran += $dibaca;
            $totalQuiz += $quizSelesai;

            if ($nilaiList->count() > 0) {
                $totalNilai = array_merge($totalNilai, $nilaiList->toArray());
            }

            $progress[] = [
                'lang'  => $kategori->nama,
                'slug'  => $kategori->slug,
                'pct'   => $pct,
                'color' => $this->warna($kategori->slug),
                'icon'  => $kategori->icon,
            ];
        }

        $totalPct = count($progress) > 0
            ? round(collect($progress)->avg('pct'))
            : 0;

        $avgNilai = count($totalNilai) > 0
            ? number_format(array_sum($totalNilai) / count($totalNilai), 1, ',', '.')
            : '0';

        return view('progress', compact(
            'progress',
            'totalPct',
            'totalPelajaran',
            'totalQuiz',
            'avgNilai'
        ));
    }

    public function java()
    {
        $kategori = Kategori::where('slug', 'java')->firstOrFail();
        $data = $this->detailProgress(Auth::user(), $kategori);
        return view('progress-detail', compact('data'));
    }

    public function python()
    {
        $kategori = Kategori::where('slug', 'python')->firstOrFail();
        $data = $this->detailProgress(Auth::user(), $kategori);
        return view('progress-detail', compact('data'));
    }

    public function php()
    {
        $kategori = Kategori::where('slug', 'php')->firstOrFail();
        $data = $this->detailProgress(Auth::user(), $kategori);
        return view('progress-detail', compact('data'));
    }

    private function detailProgress($user, $kategori)
    {
        $materis      = $kategori->materis;
        $jumlahMateri = $materis->count();

        $progresses = StudentProgress::where('user_id', $user->id)
            ->whereIn('materi_id', $materis->pluck('id'))
            ->get();

        $dibaca      = $progresses->where('materi_dibaca', true)->count();
        $quizSelesai = $progresses->where('quiz_selesai', true)->count();
        $nilaiList   = $progresses->whereNotNull('nilai_quiz')->pluck('nilai_quiz');

        $pelajaranPct = $jumlahMateri > 0 ? round(($dibaca / $jumlahMateri) * 100) : 0;
        $quizPct      = $jumlahMateri > 0 ? round(($quizSelesai / $jumlahMateri) * 100) : 0;
        $avgNilai     = $nilaiList->count() > 0 ? round($nilaiList->avg()) : 0;
        $kemajuan     = round(($pelajaranPct + $quizPct) / 2);

        return [
            'lang'      => $kategori->nama,
            'slug'      => $kategori->slug,
            'icon'      => $kategori->icon,
            'color'     => $this->warna($kategori->slug),
            'kemajuan'  => $kemajuan,
            'pelajaran' => [
                'pct'      => $pelajaranPct,
                'selesai'  => $dibaca,
                'total'    => $jumlahMateri,
            ],
            'quiz' => [
                'pct'      => $quizPct,
                'selesai'  => $quizSelesai,
                'total'    => $jumlahMateri,
            ],
            'nilai' => [
                'pct' => $avgNilai,
                'avg' => $avgNilai,
            ],
        ];
    }

    private function warna($slug): string
    {
        return match ($slug) {
            'java'   => '#3B82F6',
            'python' => '#F59E0B',
            'php'    => '#22C55E',
            default  => '#94A3B8',
        };
    }
}

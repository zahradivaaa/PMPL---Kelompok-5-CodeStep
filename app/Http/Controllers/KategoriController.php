<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\StudentProgress;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    // Halaman daftar materi per kategori
    public function show($slug)
    {
        $kategori = Kategori::where('slug', $slug)->firstOrFail();
        $materis  = $kategori->materis;
        $user     = Auth::user();

        // Ambil progress siswa untuk semua materi di kategori ini
        $progressList = StudentProgress::where('user_id', $user->id)
            ->whereIn('materi_id', $materis->pluck('id'))
            ->get()
            ->keyBy('materi_id');

        // Tentukan materi mana yang terkunci
        // Materi pertama selalu terbuka, materi berikutnya terbuka kalau materi sebelumnya sudah dibaca
        $materis = $materis->map(function ($materi, $index) use ($progressList, $materis) {
            $progress = $progressList->get($materi->id);
            $materi->sudah_dibaca  = $progress ? $progress->materi_dibaca : false;
            $materi->quiz_selesai  = $progress ? $progress->quiz_selesai : false;

            // Materi pertama selalu terbuka
            if ($index === 0) {
                $materi->terkunci = false;
            } else {
                // Cek apakah materi sebelumnya sudah dibaca
                $materiSebelumnya = $materis->get($index - 1);
                $progressSebelumnya = $progressList->get($materiSebelumnya->id);
                $materi->terkunci = !($progressSebelumnya && $progressSebelumnya->materi_dibaca);
            }

            return $materi;
        });

        return view('kategori.show', compact('kategori', 'materis'));
    }

    // Halaman baca materi + otomatis catat sudah dibaca
    public function baca(\App\Models\Materi $materi)
    {
        $user = Auth::user();

        // Cek apakah materi ini terkunci
        $kategori = $materi->kategori;
        $semuaMateri = $kategori->materis()->orderBy('urutan')->get();
        $index = $semuaMateri->search(fn($m) => $m->id === $materi->id);

        if ($index > 0) {
            $materiSebelumnya = $semuaMateri->get($index - 1);
            $progressSebelumnya = StudentProgress::where('user_id', $user->id)
                ->where('materi_id', $materiSebelumnya->id)
                ->first();

            if (!$progressSebelumnya || !$progressSebelumnya->materi_dibaca) {
                return redirect()->route('kategori.show', $kategori->slug)
                    ->with('error', 'Selesaikan materi sebelumnya terlebih dahulu!');
            }
        }

        // Otomatis catat sudah dibaca
        StudentProgress::updateOrCreate(
            ['user_id' => $user->id, 'materi_id' => $materi->id],
            ['materi_dibaca' => true]
        );

        return view('materi.baca', compact('materi', 'kategori'));
    }
}
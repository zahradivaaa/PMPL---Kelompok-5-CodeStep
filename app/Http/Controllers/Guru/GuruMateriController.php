<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruMateriController extends Controller
{
    public function index()
    {
        $materis   = Materi::with('kategori')->orderBy('kategori_id')->orderBy('urutan')->get();
        $kategoris = Kategori::all();
        return view('guru.materi', compact('materis', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'urutan'      => 'required|integer|min:1',
            'file_pdf'    => 'required|file|mimes:pdf|max:10240',
        ], [
            'file_pdf.required' => 'File PDF wajib diupload.',
            'file_pdf.mimes'    => 'File harus berformat PDF.',
            'file_pdf.max'      => 'Ukuran file maksimal 10MB.',
        ]);

        $path = $request->file('file_pdf')->store('materi', 'public');

        Materi::create([
            'kategori_id' => $request->kategori_id,
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'urutan'      => $request->urutan,
            'file_pdf'    => $path,
        ]);

        return back()->with('success', 'Materi berhasil ditambahkan!');
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'deskripsi'=> 'nullable|string',
            'urutan'   => 'required|integer|min:1',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('file_pdf')) {
            // Hapus file lama
            if ($materi->file_pdf) {
                Storage::disk('public')->delete($materi->file_pdf);
            }
            $materi->file_pdf = $request->file('file_pdf')->store('materi', 'public');
        }

        $materi->judul     = $request->judul;
        $materi->deskripsi = $request->deskripsi;
        $materi->urutan    = $request->urutan;
        $materi->save();

        return back()->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy(Materi $materi)
    {
        if ($materi->file_pdf) {
            Storage::disk('public')->delete($materi->file_pdf);
        }
        $materi->delete();
        return back()->with('success', 'Materi berhasil dihapus!');
    }
}

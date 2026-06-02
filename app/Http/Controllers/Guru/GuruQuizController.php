<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Materi;
use App\Models\HasilQuiz;
use Illuminate\Http\Request;

class GuruQuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('materi')->latest()->get();

        return view('guru.quiz.index', compact('quizzes'));
    }

    public function create()
    {
        $materis = Materi::orderBy('judul')->get();

        return view('guru.quiz.create', compact('materis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'materi_id'      => 'required|exists:materis,id',
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'durasi'         => 'required|integer|min:1',
            'tanggal_mulai'  => 'required|date',
            'deadline'       => 'required|date|after:tanggal_mulai',
        ]);

        $quiz = Quiz::create($validated);

        return redirect()
            ->route('guru.quiz.show', $quiz->id)
            ->with('success', 'Quiz berhasil dibuat!');
    }

    public function show($id)
{
    $quiz = Quiz::with(['materi', 'soals'])->findOrFail($id);
    return view('guru.quiz.show', compact('quiz'));
}

public function edit($id)
{
    $quiz    = Quiz::findOrFail($id);
    $materis = Materi::orderBy('judul')->get();
    return view('guru.quiz.edit', compact('quiz', 'materis'));
}

public function update(Request $request, $id)
{
    $quiz = Quiz::findOrFail($id);

    $validated = $request->validate([
        'materi_id'     => 'required|exists:materis,id',
        'judul'         => 'required|string|max:255',
        'deskripsi'     => 'nullable|string',
        'durasi'        => 'required|integer|min:1',
        'tanggal_mulai' => 'required|date',
        'deadline'      => 'required|date|after:tanggal_mulai',
    ]);

    $quiz->update($validated);

    return redirect()
        ->route('guru.quiz.show', $quiz->id)
        ->with('success', 'Quiz berhasil diperbarui!');
}

public function destroy($id)
{
    Quiz::findOrFail($id)->delete();

    return redirect()
        ->route('guru.quiz.index')
        ->with('success', 'Quiz berhasil dihapus!');
}

    public function hasil($id)
    {
        $quiz      = Quiz::with(['materi', 'soals'])->findOrFail($id);
        $hasilList = HasilQuiz::with('siswa')->where('quiz_id', $id)->paginate(15);

        return view('guru.quiz.hasil', compact('quiz', 'hasilList'));
    }

    public function export($id)
{
    // Nanti bisa diisi logic export Excel
    return redirect()->route('guru.quiz.hasil', $id)->with('success', 'Fitur export segera hadir.');
}
}
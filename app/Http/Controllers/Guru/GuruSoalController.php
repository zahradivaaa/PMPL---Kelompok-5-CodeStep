<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Soal;
use Illuminate\Http\Request;

class GuruSoalController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'quiz_id'       => 'required|exists:quizzes,id',
            'pertanyaan'    => 'required|string',
            'opsi_a'        => 'required|string',
            'opsi_b'        => 'required|string',
            'opsi_c'        => 'required|string',
            'opsi_d'        => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
            'poin'          => 'required|integer|min:1',
        ]);

        Soal::create($validated);

        return redirect()
            ->route('guru.quiz.show', $request->quiz_id)
            ->with('success', 'Soal berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);

        $validated = $request->validate([
            'pertanyaan'    => 'required|string',
            'opsi_a'        => 'required|string',
            'opsi_b'        => 'required|string',
            'opsi_c'        => 'required|string',
            'opsi_d'        => 'required|string',
            'jawaban_benar' => 'required|in:A,B,C,D',
            'poin'          => 'required|integer|min:1',
        ]);

        $soal->update($validated);

        return redirect()
            ->route('guru.quiz.show', $soal->quiz_id)
            ->with('success', 'Soal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);
        $quizId = $soal->quiz_id;
        $soal->delete();

        return redirect()
            ->route('guru.quiz.show', $quizId)
            ->with('success', 'Soal berhasil dihapus!');
    }
}
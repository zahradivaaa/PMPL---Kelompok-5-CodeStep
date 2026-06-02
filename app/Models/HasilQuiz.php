<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilQuiz extends Model
{
    protected $table = 'hasil_quizzes';

    protected $fillable = [
        'quiz_id',
        'user_id',
        'nilai',
        'jumlah_benar',
        'jumlah_salah',
        'durasi_menit',
        'waktu_mulai',
        'waktu_selesai',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
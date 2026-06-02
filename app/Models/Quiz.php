<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'materi_id',
        'judul',
        'deskripsi',
        'durasi',
        'tanggal_mulai',
        'deadline',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function soals()
    {
        return $this->hasMany(Soal::class);
    }

    public function hasilQuizs()
    {
        return $this->hasMany(HasilQuiz::class, 'quiz_id');
    }
}
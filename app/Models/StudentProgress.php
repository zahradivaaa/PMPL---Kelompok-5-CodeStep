<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProgress extends Model
{
    protected $fillable = [
        'user_id',
        'materi_id',
        'materi_dibaca',
        'quiz_selesai',
        'nilai_quiz',
    ];

    protected $casts = [
        'materi_dibaca' => 'boolean',
        'quiz_selesai'  => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'materi_id',
        'pertanyaan',
        'opsi_a',
        'opsi_b', 
        'opsi_c',
        'opsi_d',
        'jawaban_benar',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
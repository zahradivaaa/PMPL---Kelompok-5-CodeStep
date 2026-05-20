<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $fillable = ['kategori_id', 'judul', 'deskripsi', 'file_pdf', 'urutan'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function studentProgress()
    {
        return $this->hasMany(StudentProgress::class);
    }
}
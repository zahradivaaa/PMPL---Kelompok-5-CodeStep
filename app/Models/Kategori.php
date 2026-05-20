<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama', 'slug', 'deskripsi', 'icon'];

    public function materis()
    {
        return $this->hasMany(Materi::class)->orderBy('urutan');
    }
}
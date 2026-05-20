<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            [
                'nama'      => 'Java',
                'slug'      => 'java',
                'deskripsi' => 'Materi ini membahas dasar-dasar pemrograman menggunakan bahasa Java. Java adalah bahasa pemrograman yang banyak digunakan untuk membangun aplikasi desktop, web, dan mobile.',
                'icon'      => 'img/java.png',
            ],
            [
                'nama'      => 'Python',
                'slug'      => 'python',
                'deskripsi' => 'Materi ini membahas dasar-dasar pemrograman menggunakan bahasa Python. Python adalah bahasa pemrograman populer yang digunakan untuk membuat program atau aplikasi.',
                'icon'      => 'img/phyton.png',
            ],
            [
                'nama'      => 'PHP',
                'slug'      => 'php',
                'deskripsi' => 'Materi ini membahas dasar-dasar pemrograman menggunakan bahasa PHP. PHP adalah bahasa pemrograman yang khusus digunakan untuk membangun situs web yang dinamis dan interaktif.',
                'icon'      => 'img/php.png',
            ],
        ];

        foreach ($kategoris as $k) {
            Kategori::firstOrCreate(['slug' => $k['slug']], $k);
        }
    }
}
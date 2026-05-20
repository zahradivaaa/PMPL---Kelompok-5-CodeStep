<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'tupaikidal@codestep.com'],
            [
                'name'     => 'tupaikidal',
                'username' => 'tupaikidal',
                'password' => Hash::make('Kambingguling_001'),
            ]
        );

        $this->call([
            KategoriSeeder::class,
        ]);
    }
}
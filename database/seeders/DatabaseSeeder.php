<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'tupaikidal',
            'email'    => 'tupaikidal@codestep.com',
            'username' => 'tupaikidal',
            'password' => Hash::make('Kambingguling_001'),
        ]);

        User::create([
            'name'     => 'tupaikidal',
            'username' => 'tupaikidal',
            'email'    => 'tupaikidal@codestep.com',
            'password' => Hash::make('Kambingguling_001'),
        ]);
    }
}

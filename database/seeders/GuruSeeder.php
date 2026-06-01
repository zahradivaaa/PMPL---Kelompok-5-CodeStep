<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Pak Dimas',
            'username' => 'pak.dimas',
            'email'    => 'dimas@codestep.id',
            'password' => Hash::make('guru123'),
            'role'     => 'guru',
        ]);
    }
}
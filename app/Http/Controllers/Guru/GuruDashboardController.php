<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $siswa = User::where('role', 'siswa')->get();

        return view('guru.dashboard', compact('siswa'));
    }
}
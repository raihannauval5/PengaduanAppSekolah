<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        // Mengambil data pengaduan milik siswa yang sedang login saja
        $pengaduan_saya = Pengaduan::where('user_id', Auth::id())->latest()->get();

        return view('siswa.dashboard', compact('pengaduan_saya'));
    }
}
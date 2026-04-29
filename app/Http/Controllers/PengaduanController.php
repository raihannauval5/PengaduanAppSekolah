<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'judul' => 'required',
            'isi_laporan' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        // 2. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login')->withErrors('Silakan login dulu.');
        }

        // 3. Proses Foto
        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $namaFoto = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $namaFoto);
        }

        // 4. Simpan ke DB
/// Bagian simpan data yang benar
$simpan = Pengaduan::create([
    'user_id'     => Auth::id(),
    'judul'       => $request->judul,
    'isi_laporan' => $request->isi_laporan,
    'foto'        => $namaFoto,
    'status'      => 'pending', // Cukup tulis 'pending' saja di sini
]);

        if ($simpan) {
            return back()->with('success', 'Aspirasi berhasil dikirim!');
        }

        return back()->with('error', 'Gagal menyimpan data.');
    }
}
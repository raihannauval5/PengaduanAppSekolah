<?php
namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    // Mengambil semua data dari tabel pengaduans
    $semua_pengaduan = \App\Models\Pengaduan::all(); 
    
    // Pastiin return view-nya ngirim variabel $semua_pengaduan
    return view('admin.dashboard', compact('semua_pengaduan'));
}

    public function beriTanggapan(Request $request, $id)
    {
        // Validasi Feedback (Kotak: Isi Feedback Valid?)
        $request->validate([
            'feedback' => 'required'
        ], [
            'feedback.required' => 'Feedback tidak boleh kosong'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        
        // Update ke DB
        $pengaduan->update([
            'status' => 'selesai',
            'feedback' => $request->feedback
        ]);

        return back()->with('success', 'Berhasil memberikan feedback!');
    }
    public function updateStatus(Request $request, $id)
{
    $pengaduan = \App\Models\Pengaduan::findOrFail($id);
    
    // Update status dan feedback (tanggapan)
    $pengaduan->update([
        'status'   => $request->status,
        'feedback' => $request->feedback
    ]);

    return back()->with('success', 'Status berhasil diperbarui!');
}
}


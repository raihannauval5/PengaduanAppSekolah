<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    // Pastiin semua kolom ini ada biar gak "diusir" sama Laravel
    protected $fillable = [
        'user_id',
        'judul',
        'isi_laporan',
        'foto',
        'status',
        'feedback'
    ];

    // Relasi ke User (Siswa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
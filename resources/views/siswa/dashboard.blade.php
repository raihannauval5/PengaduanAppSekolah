<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa - PengaduanAppSekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary mb-4 shadow-sm">
        <div class="container">
            <span class="navbar-brand">Siswa Dashboard</span>
            <form action="/logout" method="POST">
                @csrf 
                <button class="btn btn-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Form Pengaduan Siswa</h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                       <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Judul Laporan</label>
                                <input type="text" name="judul" class="form-control" placeholder="Contoh: Kursi Kelas Rusak" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Isi Laporan / Aspirasi</label>
                                <textarea name="isi_laporan" class="form-control" rows="4" placeholder="Jelaskan detail pengaduan..." required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto Bukti (Opsional)</label>
                                <input type="file" name="foto" class="form-control">
                                <small class="text-muted">Format: jpg, png (Max 2MB)</small>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Kirim Pengaduan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Riwayat Pengaduan Saya</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Judul</th>
                                        <th>Status</th>
                                        <th>Tanggapan Sekolah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pengaduan_saya as $p)
                                    <tr>
                                        <td><strong>{{ $p->judul }}</strong></td>
                                        <td>
                                            @if($p->status == 'pending')
                                                <span class="badge bg-danger">Pending</span>
                                            @elseif($p->status == 'proses')
                                                <span class="badge bg-warning text-dark">Proses</span>
                                            @else
                                                <span class="badge bg-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-muted small">
                                                {{ $p->feedback ?? 'Belum ada tanggapan dari admin.' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Lo belum pernah buat laporan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
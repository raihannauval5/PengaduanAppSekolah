<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - PengaduanAppSekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand">Admin Panel</span>
            <form action="/logout" method="POST">@csrf <button class="btn btn-outline-light btn-sm">Logout</button></form>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <div class="container mt-5">
    <h2>Admin Panel - Daftar Aspirasi</h2>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Pelapor</th>
                <th>Judul</th>
                <th>Laporan</th>
                <th>Status</th>
                <th>Aksi & Tanggapan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semua_pengaduan as $item)
            <tr>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->isi_laporan }}</td>
                <td>
                    @if($item->status == 'pending')
                        <span class="badge bg-danger text-white">PENDING</span>
                    @elseif($item->status == 'proses')
                        <span class="badge bg-warning text-dark">PROSES</span>
                    @else
                        <span class="badge bg-success text-white">SELESAI</span>
                    @endif
                </td>
                <td>
                    <form action="/admin/pengaduan/update/{{ $item->id }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <select name="status" class="form-select form-select-sm">
                                <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" {{ $item->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <input type="text" name="feedback" class="form-control form-control-sm" placeholder="Tanggapan..." value="{{ $item->feedback }}">
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada laporan masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
        </div>
    </div>
</body>
</html>
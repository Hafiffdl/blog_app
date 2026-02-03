<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="mb-3">Permohonan KI Saya</h2>
                <a href="{{ route('ki.index') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajukan Permohonan Baru
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis KI</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usulan as $index => $item)
                            <tr>
                                <td>{{ $usulan->firstItem() + $index }}</td>
                                <td>
                                    <i class="fas {{ $item->mstKi->icon }}"></i>
                                    {{ $item->mstKi->nama }}
                                </td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                                <td>
                                    @if($item->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($item->status === 'approved')
                                        <span class="badge bg-success">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" onclick="viewDetail({{ $item->id }})">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    
                                    @if($item->status === 'pending')
                                    <a href="{{ route('ki.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id }})">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada permohonan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan {{ $usulan->firstItem() }} sampai {{ $usulan->lastItem() }} dari {{ $usulan->total() }} hasil
                    </div>
                    <div>
                        {{ $usulan->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function viewDetail(id) {
            alert('Detail ID: ' + id);
        }

        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus permohonan ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>

    <!-- Delete Forms (Hidden) -->
    @foreach($usulan as $item)
    <form id="delete-form-{{ $item->id }}" 
          action="{{ route('ki.destroy', $item->id) }}" 
          method="POST" 
          style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    @endforeach
</body>
</html>

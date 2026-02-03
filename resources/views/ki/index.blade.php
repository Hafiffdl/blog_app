<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kekayaan Intelektual</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .ki-card {
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100%;
        }
        .ki-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .ki-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="mb-3">Pilih Jenis Kekayaan Intelektual</h2>
                <p class="text-muted">Silakan pilih salah satu jenis KI yang ingin Anda daftarkan</p>
            </div>
            <div class="col-md-4 text-end">
                @auth
                <a href="{{ route('ki.my-submissions') }}" class="btn btn-outline-primary">
                    <i class="fas fa-list"></i> Permohonan Saya
                </a>
                @endauth
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row g-4">
            @foreach($jenisKi as $ki)
            <div class="col-md-4">
                <a href="{{ route('ki.create', $ki->id) }}" class="text-decoration-none">
                    <div class="card ki-card h-100">
                        <div class="card-body text-center">
                            {{-- <i class="fas fa-certificate ki-icon"></i> --}}
                            <h5 class="card-title text-dark">{{ $ki->nama }}</h5>
                            <p class="card-text text-muted">{{ $ki->deskripsi }}</p>
                            <span class="btn btn-primary btn-sm mt-2">
                                <i class="fas fa-arrow-right"></i> Ajukan
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

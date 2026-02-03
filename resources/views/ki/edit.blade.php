<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit {{ $ki->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('ki.my-submissions') }}" class="btn btn-outline-secondary mb-3">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <h2 class="mb-3">Edit Permohonan {{ $ki->nama }}</h2>
                <p class="text-muted">{{ $ki->deskripsi }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('ki.update', $usulan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Common Fields -->
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul KI <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                               id="judul" name="judul" value="{{ old('judul', $usulan->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                               id="tanggal" name="tanggal" value="{{ old('tanggal', $usulan->tanggal->format('Y-m-d')) }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                  id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $usulan->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    <!-- Dynamic Fields Based on KI Type -->
                    <h5 class="mb-3">Syarat-syarat Khusus {{ $ki->nama }}</h5>

                    @foreach($ki->syarat as $syarat)
                    <div class="mb-3">
                        <label for="field_{{ $syarat->id }}" class="form-label">
                            {{ $syarat->nama }} <span class="text-danger">*</span>
                        </label>

                        @if($syarat->tipe === 'text')
                            <input type="text" class="form-control" id="field_{{ $syarat->id }}" 
                                   name="field_{{ $syarat->id }}" value="{{ old('field_'.$syarat->id) }}" required>
                        @elseif($syarat->tipe === 'textarea')
                            <textarea class="form-control" id="field_{{ $syarat->id }}" 
                                      name="field_{{ $syarat->id }}" rows="3" required>{{ old('field_'.$syarat->id) }}</textarea>
                        @elseif($syarat->tipe === 'date')
                            <input type="date" class="form-control" id="field_{{ $syarat->id }}" 
                                   name="field_{{ $syarat->id }}" value="{{ old('field_'.$syarat->id) }}" required>
                        @elseif($syarat->tipe === 'file')
                            <input type="file" class="form-control" id="field_{{ $syarat->id }}" 
                                   name="field_{{ $syarat->id }}">
                            <small class="text-muted">Format: pdf, doc, docx, max 10 MB. Kosongkan jika tidak ingin mengubah file.</small>
                        @elseif($syarat->tipe === 'json' && $syarat->value)
                            <select class="form-select" id="field_{{ $syarat->id }}" 
                                    name="field_{{ $syarat->id }}" required>
                                <option value="">-- Pilih {{ $syarat->nama }} --</option>
                                @foreach(json_decode($syarat->value) as $option)
                                    <option value="{{ $option }}" {{ old('field_'.$syarat->id) == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    @endforeach

                    <hr>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('ki.my-submissions') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
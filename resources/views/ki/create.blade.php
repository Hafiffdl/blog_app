@extends('layouts.app')

@section('title', 'Ajukan ' . $ki->nama)

@section('content')
    <div class="mx-auto max-w-3xl px-4 py-12 sm:px-6">
        <a href="{{ route('ki.index') }}" class="btn-outline btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="mt-6 flex items-start gap-4">
            <span class="grid h-12 w-12 shrink-0 place-items-center rounded-xl bg-gradient-to-br from-primary-500 to-indigo-600 text-white">
                <i class="bi bi-patch-check-fill"></i>
            </span>
            <div>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Formulir Pengajuan {{ $ki->nama }}</h1>
                <p class="mt-1 text-slate-500">{{ $ki->deskripsi }}</p>
            </div>
        </div>

        <div class="card mt-8">
            <div class="card-body">
                @if($errors->any())
                    <div class="mb-6 flex items-start gap-3 rounded-lg border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800">
                        <i class="bi bi-exclamation-circle-fill mt-0.5 text-rose-500"></i>
                        <div class="flex-1">
                            <p class="font-semibold">Mohon perbaiki beberapa hal berikut:</p>
                            <ul class="mt-1 list-inside list-disc">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('ki.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="mst_ki_id" value="{{ $ki->id }}">

                    <div>
                        <label for="judul" class="form-label">Judul KI <span class="text-rose-500">*</span></label>
                        <input type="text" class="form-control @error('judul') border-rose-400 @enderror"
                               id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Aplikasi Pencatatan Keuangan" required>
                    </div>

                    <div>
                        <label for="tanggal" class="form-label">Tanggal <span class="text-rose-500">*</span></label>
                        <input type="date" class="form-control @error('tanggal') border-rose-400 @enderror"
                               id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                    </div>

                    <div>
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') border-rose-400 @enderror"
                                  id="deskripsi" name="deskripsi" rows="3" placeholder="Jelaskan secara singkat KI yang diajukan">{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="border-t border-slate-200 pt-6">
                        <h5 class="mb-4 flex items-center gap-2 text-base font-bold text-slate-900">
                            <i class="bi bi-clipboard-check text-primary-600"></i> Syarat-syarat Khusus {{ $ki->nama }}
                        </h5>

                        <div class="space-y-6">
                            @foreach($ki->syarat as $syarat)
                                <div>
                                    <label for="field_{{ $syarat->id }}" class="form-label">
                                        {{ $syarat->nama }} <span class="text-rose-500">*</span>
                                    </label>

                                    @if($syarat->tipe === 'text')
                                        <input type="text" class="form-control @error('field_'.$syarat->id) border-rose-400 @enderror"
                                               id="field_{{ $syarat->id }}" name="field_{{ $syarat->id }}"
                                               value="{{ old('field_'.$syarat->id) }}" required>

                                    @elseif($syarat->tipe === 'textarea')
                                        <textarea class="form-control @error('field_'.$syarat->id) border-rose-400 @enderror"
                                                  id="field_{{ $syarat->id }}" name="field_{{ $syarat->id }}"
                                                  rows="3" required>{{ old('field_'.$syarat->id) }}</textarea>

                                    @elseif($syarat->tipe === 'date')
                                        <input type="date" class="form-control @error('field_'.$syarat->id) border-rose-400 @enderror"
                                               id="field_{{ $syarat->id }}" name="field_{{ $syarat->id }}"
                                               value="{{ old('field_'.$syarat->id) }}" required>

                                    @elseif($syarat->tipe === 'file')
                                        <input type="file" class="form-control @error('field_'.$syarat->id) border-rose-400 @enderror"
                                               id="field_{{ $syarat->id }}" name="field_{{ $syarat->id }}" required>
                                        <p class="mt-1.5 text-xs text-slate-400">Format: pdf, doc, docx, maks 10 MB</p>

                                    @elseif($syarat->tipe === 'json' && $syarat->value)
                                        <select class="form-control @error('field_'.$syarat->id) border-rose-400 @enderror"
                                                id="field_{{ $syarat->id }}" name="field_{{ $syarat->id }}" required>
                                            <option value="">-- Pilih {{ $syarat->nama }} --</option>
                                            @foreach(json_decode($syarat->value) as $option)
                                                <option value="{{ $option }}" {{ old('field_'.$syarat->id) == $option ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif

                                    @error('field_'.$syarat->id)
                                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3 border-t border-slate-200 pt-6">
                        <button type="submit" class="btn-primary">
                            <i class="bi bi-send"></i> Ajukan Permohonan
                        </button>
                        <a href="{{ route('ki.index') }}" class="btn-outline">
                            <i class="bi bi-x-lg"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

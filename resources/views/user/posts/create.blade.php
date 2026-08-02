@extends('user.layout')

@section('title', 'Buat Postingan')
@section('page-title', 'Buat Postingan Baru')
@section('page-description', 'Tulis artikel baru')

@section('content')
    <div class="mx-auto max-w-3xl">
        <div class="card">
            <div class="card-header">
                <h3 class="text-base font-bold text-slate-900">Buat Postingan Baru</h3>
            </div>

            <form method="POST" action="{{ route('user.posts.store') }}">
                @csrf

                <div class="card-body space-y-5">
                    @if($errors->any())
                        <div class="flex items-start gap-3 rounded-lg border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800">
                            <i class="bi bi-exclamation-circle-fill mt-0.5 text-rose-500"></i>
                            <div class="flex-1">
                                <ul class="list-inside list-disc">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div>
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="{{ old('title') }}" placeholder="Masukkan judul artikel" required>
                    </div>

                    <div>
                        <label for="content" class="form-label">Konten</label>
                        <textarea class="form-control" id="content" name="content"
                                  rows="15" placeholder="Tulis konten kamu di sini..." required>{{ old('content') }}</textarea>
                    </div>

                    <div class="flex items-start gap-3 rounded-lg border border-sky-200 bg-sky-50 p-4 text-sm text-sky-800">
                        <i class="bi bi-info-circle-fill mt-0.5 text-sky-500"></i>
                        <p>Postingan kamu akan ditinjau oleh admin sebelum diterbitkan.</p>
                    </div>
                </div>

                <div class="flex items-center justify-between gap-3 border-t border-slate-200 px-6 py-5">
                    <a href="{{ route('user.posts.index') }}" class="btn-outline">
                        Batal
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="bi bi-send"></i> Kirim untuk Persetujuan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

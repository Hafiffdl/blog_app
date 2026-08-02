@extends('layouts.app')

@section('title', 'Kekayaan Intelektual')

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-primary-900">
        <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-primary-600/30 blur-3xl"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8">
            <div class="flex flex-wrap items-end justify-between gap-6">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1.5 text-xs font-semibold text-primary-200 backdrop-blur">
                        <i class="bi bi-award"></i> Layanan Kekayaan Intelektual
                    </span>
                    <h1 class="mt-5 text-3xl font-extrabold text-white sm:text-4xl">Pilih Jenis Kekayaan Intelektual</h1>
                    <p class="mt-3 text-lg text-slate-300">Silakan pilih salah satu jenis KI yang ingin kamu daftarkan.</p>
                </div>
                @auth
                    <a href="{{ route('ki.my-submissions') }}" class="btn bg-white text-slate-900 hover:bg-slate-100 focus:ring-white">
                        <i class="bi bi-list-check"></i> Permohonan Saya
                    </a>
                @endauth
            </div>
        </div>
    </section>

    @if(session('success'))
        <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
            <div class="flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
                <i class="bi bi-check-circle-fill mt-0.5 text-emerald-500"></i>
                <div class="flex-1">{{ session('success') }}</div>
                <button type="button" class="text-emerald-400 hover:text-emerald-600" onclick="this.parentElement.remove()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>
    @endif

    {{-- Kartu jenis KI --}}
    <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        @if($jenisKi->count() > 0)
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($jenisKi as $ki)
                    <a href="{{ route('ki.create', $ki->id) }}" class="card group flex flex-col p-6 transition-all hover:-translate-y-1 hover:border-primary-300 hover:shadow-lg">
                        <span class="grid h-14 w-14 place-items-center rounded-xl bg-gradient-to-br from-primary-500 to-indigo-600 text-2xl text-white shadow-sm">
                            <i class="bi bi-patch-check-fill"></i>
                        </span>
                        <h3 class="mt-5 text-lg font-bold text-slate-900 group-hover:text-primary-600">{{ $ki->nama }}</h3>
                        <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-500">{{ $ki->deskripsi }}</p>
                        <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-primary-600">
                            Ajukan <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                        </span>
                    </a>
                @endforeach
            </div>
        @else
            <div class="card flex flex-col items-center justify-center p-16 text-center">
                <span class="grid h-16 w-16 place-items-center rounded-full bg-slate-100 text-3xl text-slate-400">
                    <i class="bi bi-award"></i>
                </span>
                <h3 class="mt-4 text-lg font-bold text-slate-900">Belum Ada Jenis KI</h3>
                <p class="mt-1 text-sm text-slate-500">Mohon kembali lagi nanti.</p>
            </div>
        @endif
    </div>
@endsection

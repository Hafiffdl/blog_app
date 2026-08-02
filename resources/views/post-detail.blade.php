@extends('layouts.app')

@section('title', $post->title)

@section('content')
    {{-- Header artikel --}}
    <header class="relative overflow-hidden bg-gradient-to-br from-primary-700 via-primary-600 to-indigo-500">
        <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-white/10 blur-2xl"></div>
        <div class="relative mx-auto max-w-4xl px-4 py-16 sm:px-6 sm:py-20">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-lg bg-white/15 px-3.5 py-2 text-sm font-semibold text-white backdrop-blur transition-colors hover:bg-white/25">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
            <h1 class="mt-6 text-3xl font-extrabold leading-tight text-white sm:text-4xl lg:text-5xl">
                {{ $post->title }}
            </h1>
            <div class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-white/80">
                <div class="flex items-center gap-3">
                    <span class="grid h-11 w-11 place-items-center rounded-full bg-white/20 text-sm font-bold text-white backdrop-blur">
                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                    </span>
                    <div class="leading-tight">
                        <p class="font-semibold text-white">{{ $post->user->name }}</p>
                        <p class="text-xs text-white/70">Penulis</p>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1.5">
                    <i class="bi bi-calendar3"></i> {{ $post->created_at->format('d F Y') }}
                </span>
                <span class="inline-flex items-center gap-1.5">
                    <i class="bi bi-clock"></i> {{ max(1, ceil(str_word_count($post->content) / 200)) }} menit baca
                </span>
            </div>
        </div>
    </header>

    {{-- Isi artikel --}}
    <div class="mx-auto max-w-4xl px-4 py-12 sm:px-6">
        <article class="card p-8 sm:p-12">
            <div class="whitespace-pre-wrap text-lg leading-relaxed text-slate-700">
                {!! nl2br(e($post->content)) !!}
            </div>
        </article>

        {{-- Tentang penulis --}}
        <div class="mt-8 flex flex-col items-start gap-4 rounded-xl border border-slate-200 bg-white p-6 sm:flex-row sm:items-center">
            <span class="grid h-14 w-14 shrink-0 place-items-center rounded-full bg-primary-100 text-xl font-bold text-primary-700">
                {{ strtoupper(substr($post->user->name, 0, 1)) }}
            </span>
            <div class="flex-1">
                <p class="font-semibold text-slate-900">{{ $post->user->name }}</p>
                <p class="text-sm text-slate-500">Penulis artikel ini</p>
            </div>
            <a href="{{ route('home') }}" class="btn-outline btn-sm">
                <i class="bi bi-arrow-left"></i> Lihat Artikel Lainnya
            </a>
        </div>
    </div>
@endsection

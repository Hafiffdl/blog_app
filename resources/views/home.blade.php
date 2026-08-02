@extends('layouts.app')

@section('title', 'BlogApp - Beranda')

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-primary-700 via-primary-600 to-indigo-500">
        <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-white/10 blur-2xl"></div>
        <div class="absolute -bottom-32 -left-16 h-96 w-96 rounded-full bg-white/10 blur-2xl"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 sm:py-28 lg:px-8">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1.5 text-xs font-semibold text-white backdrop-blur">
                    <i class="bi bi-stars"></i> Tempat berbagi cerita terbaik
                </span>
                <h1 class="mt-6 text-4xl font-extrabold leading-tight text-white sm:text-5xl lg:text-6xl">
                    Tulis, bagikan, dan<br class="hidden sm:block"> inspirasi banyak orang.
                </h1>
                <p class="mt-5 max-w-2xl text-lg text-white/80">
                    Jelajahi artikel menarik dari komunitas kami dan bagikan pemikiranmu kepada dunia. Semua konten melewati moderasi agar tetap berkualitas.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#posts" class="btn bg-white text-primary-700 hover:bg-slate-100 focus:ring-white">
                        <i class="bi bi-journal-text"></i> Jelajahi Artikel
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="btn bg-white/10 text-white ring-1 ring-inset ring-white/30 backdrop-blur hover:bg-white/20 focus:ring-white">
                            <i class="bi bi-pencil-square"></i> Mulai Menulis
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    {{-- Statistik / fitur --}}
    <section class="mx-auto -mt-8 max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-4 sm:grid-cols-3">
            <div class="card flex items-center gap-4 p-5">
                <span class="grid h-12 w-12 place-items-center rounded-xl bg-primary-50 text-primary-600">
                    <i class="bi bi-journal-text text-xl"></i>
                </span>
                <div>
                    <p class="text-2xl font-bold text-slate-900">{{ number_format(\App\Models\Post::approved()->count()) }}</p>
                    <p class="text-sm text-slate-500">Artikel terbit</p>
                </div>
            </div>
            <div class="card flex items-center gap-4 p-5">
                <span class="grid h-12 w-12 place-items-center rounded-xl bg-emerald-50 text-emerald-600">
                    <i class="bi bi-people text-xl"></i>
                </span>
                <div>
                    <p class="text-2xl font-bold text-slate-900">{{ number_format(\App\Models\User::count()) }}</p>
                    <p class="text-sm text-slate-500">Penulis aktif</p>
                </div>
            </div>
            <div class="card flex items-center gap-4 p-5">
                <span class="grid h-12 w-12 place-items-center rounded-xl bg-amber-50 text-amber-600">
                    <i class="bi bi-award text-xl"></i>
                </span>
                <div>
                    <p class="text-2xl font-bold text-slate-900">100%</p>
                    <p class="text-sm text-slate-500">Konten termoderasi</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Daftar artikel --}}
    <section id="posts" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 sm:text-3xl">Artikel Terbaru</h2>
                <p class="mt-1 text-slate-500">Kumpulan tulisan terbaik dari para penulis kami.</p>
            </div>
            <a href="{{ route('ki.index') }}" class="btn-outline btn-sm">
                <i class="bi bi-award"></i> Pengajuan Kekayaan Intelektual
            </a>
        </div>

        @if($posts->count() > 0)
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($posts as $post)
                    <article class="card group flex flex-col overflow-hidden transition-shadow hover:shadow-lg">
                        <div class="flex h-44 items-center justify-center bg-gradient-to-br from-primary-500 to-indigo-600 text-5xl text-white/90">
                            <i class="bi bi-newspaper"></i>
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <h3 class="text-lg font-bold text-slate-900 transition-colors group-hover:text-primary-600 line-clamp-2">
                                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-500 line-clamp-3">
                                {{ Str::limit(strip_tags($post->content), 150) }}
                            </p>
                            <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">
                                <div class="flex items-center gap-2.5">
                                    <span class="grid h-8 w-8 place-items-center rounded-full bg-primary-100 text-xs font-bold text-primary-700">
                                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                    </span>
                                    <div class="leading-tight">
                                        <p class="text-xs font-semibold text-slate-700">{{ $post->user->name }}</p>
                                        <p class="text-xs text-slate-400">{{ $post->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('posts.show', $post) }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">
                                    Baca <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                {{ $posts->links() }}
            </div>
        @else
            <div class="card flex flex-col items-center justify-center p-16 text-center">
                <span class="grid h-16 w-16 place-items-center rounded-full bg-slate-100 text-3xl text-slate-400">
                    <i class="bi bi-inbox"></i>
                </span>
                <h3 class="mt-4 text-lg font-bold text-slate-900">Belum Ada Artikel</h3>
                <p class="mt-1 text-sm text-slate-500">Jadilah penulis pertama yang berbagi cerita!</p>
                @auth
                    @if(auth()->user()->role === 'user')
                        <a href="{{ route('user.posts.create') }}" class="btn-primary mt-5">
                            <i class="bi bi-plus-lg"></i> Tulis Artikel Pertama
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="btn-primary mt-5">
                        <i class="bi bi-person-plus"></i> Daftar untuk Menulis
                    </a>
                @endauth
            </div>
        @endif
    </section>

    {{-- CTA --}}
    <section class="mx-auto max-w-7xl px-4 pb-8 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-2xl bg-slate-900 p-10 text-center sm:p-16">
            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-primary-600/30 blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 h-64 w-64 rounded-full bg-indigo-600/30 blur-3xl"></div>
            <div class="relative">
                <h2 class="text-2xl font-bold text-white sm:text-3xl">Siap berbagi ceritamu?</h2>
                <p class="mx-auto mt-3 max-w-xl text-slate-400">
                    Bergabunglah dengan komunitas penulis kami dan mulai inspirasi ribuan pembaca hari ini.
                </p>
                <div class="mt-6 flex flex-wrap justify-center gap-3">
                    @guest
                        <a href="{{ route('register') }}" class="btn bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500">
                            <i class="bi bi-rocket-takeoff"></i> Daftar Gratis
                        </a>
                    @else
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" class="btn bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500">
                            <i class="bi bi-speedometer2"></i> Buka Dashboard
                        </a>
                    @endauth
                    <a href="{{ route('ki.index') }}" class="btn bg-white/10 text-white ring-1 ring-inset ring-white/30 backdrop-blur hover:bg-white/20">
                        <i class="bi bi-award"></i> Daftarkan KI
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

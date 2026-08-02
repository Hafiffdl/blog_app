<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Autentikasi')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen flex">
    {{-- Panel kiri: branding --}}
    <div class="relative hidden lg:flex lg:w-1/2 flex-col justify-between overflow-hidden bg-gradient-to-br from-primary-700 via-primary-600 to-indigo-500 p-12 text-white">
        <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-white/10 blur-2xl"></div>
        <div class="absolute -bottom-32 -left-16 h-96 w-96 rounded-full bg-white/10 blur-2xl"></div>

        <a href="{{ route('home') }}" class="relative flex items-center gap-2.5">
            <span class="grid h-10 w-10 place-items-center rounded-xl bg-white/15 backdrop-blur">
                <i class="bi bi-newspaper text-lg"></i>
            </span>
            <span class="text-xl font-bold">Blog<span class="text-white/80">App</span></span>
        </a>

        <div class="relative">
            <h1 class="text-3xl font-bold leading-tight">
                Bagikan ide dan kisah<br>kamu dengan dunia.
            </h1>
            <p class="mt-4 max-w-md text-white/80">
                Platform untuk menulis, berbagi, dan mengelola konten dengan alur moderasi yang transparan.
            </p>
            <div class="mt-8 flex flex-wrap gap-3 text-sm">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 backdrop-blur">
                    <i class="bi bi-check-circle-fill text-emerald-300"></i> Publikasi cepat
                </span>
                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 backdrop-blur">
                    <i class="bi bi-shield-check text-emerald-300"></i> Moderasi aman
                </span>
            </div>
        </div>

        <p class="relative text-sm text-white/60">&copy; {{ date('Y') }} BlogApp. All rights reserved.</p>
    </div>

    {{-- Panel kanan: form --}}
    <div class="flex flex-1 items-center justify-center bg-slate-50 px-4 py-12">
        <div class="w-full max-w-md">
            <div class="mb-8 lg:hidden">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-primary-600 text-white">
                        <i class="bi bi-newspaper"></i>
                    </span>
                    <span class="text-xl font-bold text-slate-900">Blog<span class="text-primary-600">App</span></span>
                </a>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                @yield('content')
            </div>

            <p class="mt-6 text-center text-sm text-slate-500">
                <a href="{{ route('home') }}" class="font-medium text-primary-600 hover:text-primary-700">
                    <i class="bi bi-arrow-left"></i> Kembali ke beranda
                </a>
            </p>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

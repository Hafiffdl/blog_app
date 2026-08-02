<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Blog'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col">
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-slate-200">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-primary-600 text-white shadow-sm">
                        <i class="bi bi-newspaper"></i>
                    </span>
                    <span class="text-lg font-bold tracking-tight text-slate-900">
                        Blog<span class="text-primary-600">App</span>
                    </span>
                </a>

                <nav class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('home') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        Beranda
                    </a>
                    <a href="{{ route('ki.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium {{ request()->routeIs('ki.*') ? 'bg-primary-50 text-primary-700' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        Kekayaan Intelektual
                    </a>
                </nav>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" class="btn-outline btn-sm hidden sm:inline-flex">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="btn-outline btn-sm">
                                <i class="bi bi-box-arrow-right"></i> Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary btn-sm">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="mt-16 border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-between gap-6 sm:flex-row">
                <div class="flex items-center gap-2">
                    <span class="grid h-8 w-8 place-items-center rounded-lg bg-primary-600 text-white">
                        <i class="bi bi-newspaper"></i>
                    </span>
                    <span class="text-sm font-semibold text-slate-900">BlogApp</span>
                </div>
                <p class="text-sm text-slate-500">
                    &copy; {{ date('Y') }} BlogApp. Seluruh hak cipta dilindungi.
                </p>
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="text-sm text-slate-500 hover:text-primary-600">Beranda</a>
                    <a href="{{ route('ki.index') }}" class="text-sm text-slate-500 hover:text-primary-600">KI</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

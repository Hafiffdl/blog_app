<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 -translate-x-full bg-slate-900 transition-transform duration-200 lg:translate-x-0 lg:static lg:shrink-0">
            <div class="flex h-full flex-col">
                <div class="flex h-16 items-center gap-3 border-b border-slate-800 px-6">
                    <span class="grid h-9 w-9 place-items-center rounded-lg bg-primary-600 text-white">
                        <i class="bi bi-newspaper"></i>
                    </span>
                    <div>
                        <p class="text-sm font-bold text-white">Admin Panel</p>
                        <p class="text-xs text-slate-400">Kelola Konten</p>
                    </div>
                </div>

                <nav class="flex-1 space-y-1 overflow-y-auto p-4">
                    <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Menu</p>

                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="bi bi-speedometer2 w-5 text-center"></i> Dashboard
                    </a>

                    <a href="{{ route('admin.posts.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ request()->routeIs('admin.posts.*') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="bi bi-file-earmark-text w-5 text-center"></i> Pelaporan
                    </a>

                    <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium {{ request()->routeIs('admin.faqs.*') ? 'bg-primary-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i class="bi bi-question-circle w-5 text-center"></i> FAQ
                    </a>
                </nav>

                <div class="border-t border-slate-800 p-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white">
                            <i class="bi bi-box-arrow-right w-5 text-center"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Overlay untuk mobile --}}
        <div id="sidebar-overlay" class="fixed inset-0 z-40 hidden bg-black/50"></div>

        {{-- Konten utama --}}
        <div class="flex min-h-screen flex-1 flex-col">
            {{-- Topbar --}}
            <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-slate-200 bg-white/90 px-4 backdrop-blur sm:px-6">
                <div class="flex items-center gap-3">
                    <button id="sidebar-toggle" class="btn-outline btn-sm lg:hidden">
                        <i class="bi bi-list"></i>
                    </button>
                    <div>
                        <h1 class="text-base font-bold text-slate-900">@yield('page-title', 'Dashboard')</h1>
                        <p class="hidden text-xs text-slate-500 sm:block">@yield('page-description', 'Halaman admin')</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="btn-outline btn-sm hidden sm:inline-flex">
                        <i class="bi bi-box-arrow-up-right"></i> Lihat Website
                    </a>
                    <div class="flex items-center gap-2.5 rounded-full border border-slate-200 bg-white py-1.5 pl-1.5 pr-4">
                        <span class="grid h-8 w-8 place-items-center rounded-full bg-primary-600 text-xs font-bold text-white">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                        <div class="leading-tight">
                            <p class="text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-500">Administrator</p>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Konten --}}
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-5 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
                        <i class="bi bi-check-circle-fill mt-0.5 text-emerald-500"></i>
                        <div class="flex-1">{{ session('success') }}</div>
                        <button type="button" class="text-emerald-400 hover:text-emerald-600" onclick="this.parentElement.remove()">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-5 flex items-start gap-3 rounded-lg border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800">
                        <i class="bi bi-exclamation-circle-fill mt-0.5 text-rose-500"></i>
                        <div class="flex-1">{{ session('error') }}</div>
                        <button type="button" class="text-rose-400 hover:text-rose-600" onclick="this.parentElement.remove()">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggle = document.getElementById('sidebar-toggle');

        if (toggle && sidebar && overlay) {
            toggle.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            });
            overlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            });
        }

        document.querySelectorAll('[data-confirm]').forEach((form) => {
            form.addEventListener('submit', (e) => {
                if (!confirm(form.dataset.confirm)) e.preventDefault();
            });
        });
    </script>
    @stack('scripts')
</body>
</html>

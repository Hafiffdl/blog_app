@extends('user.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan aktivitas kamu')

@section('content')
    {{-- Kartu statistik --}}
    <div class="grid gap-4 sm:grid-cols-3">
        <div class="card flex items-center gap-4 p-5">
            <span class="grid h-12 w-12 place-items-center rounded-xl bg-emerald-50 text-emerald-600">
                <i class="bi bi-file-earmark-text text-xl"></i>
            </span>
            <div>
                <p class="text-2xl font-bold text-slate-900">{{ number_format($totalPosts) }}</p>
                <p class="text-sm text-slate-500">Total Postingan</p>
            </div>
        </div>

        <div class="card flex items-center gap-4 p-5">
            <span class="grid h-12 w-12 place-items-center rounded-xl bg-amber-50 text-amber-600">
                <i class="bi bi-clock-history text-xl"></i>
            </span>
            <div>
                <p class="text-2xl font-bold text-slate-900">{{ number_format($pendingPosts) }}</p>
                <p class="text-sm text-slate-500">Menunggu Review</p>
            </div>
        </div>

        <div class="card flex items-center gap-4 p-5">
            <span class="grid h-12 w-12 place-items-center rounded-xl bg-sky-50 text-sky-600">
                <i class="bi bi-check-circle text-xl"></i>
            </span>
            <div>
                <p class="text-2xl font-bold text-slate-900">{{ number_format($approvedPosts) }}</p>
                <p class="text-sm text-slate-500">Telah Disetujui</p>
            </div>
        </div>
    </div>

    {{-- Aksi cepat --}}
    <div class="card mt-6">
        <div class="card-header">
            <h3 class="text-base font-bold text-slate-900">Aksi Cepat</h3>
        </div>
        <div class="card-body">
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('user.posts.create') }}" class="btn-primary">
                    <i class="bi bi-plus-lg"></i> Buat Postingan Baru
                </a>
                <a href="{{ route('user.posts.index') }}" class="btn-outline">
                    <i class="bi bi-list-check"></i> Kelola Postingan Saya
                </a>
                <a href="{{ route('home') }}" target="_blank" class="btn-outline">
                    <i class="bi bi-eye"></i> Lihat Website Publik
                </a>
            </div>
        </div>
    </div>

    {{-- Postingan terbaru --}}
    <div class="card mt-6">
        <div class="card-header">
            <h3 class="text-base font-bold text-slate-900">Postingan Terbaru Saya</h3>
            <a href="{{ route('user.posts.index') }}" class="btn-outline btn-sm">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(auth()->user()->posts()->latest()->take(5)->get() as $post)
                        <tr>
                            <td class="max-w-xs">
                                <span class="block truncate font-medium text-slate-900">{{ $post->title }}</span>
                            </td>
                            <td>
                                @if($post->status === 'pending')
                                    <span class="badge-pending"><i class="bi bi-clock"></i> Pending</span>
                                @elseif($post->status === 'approved')
                                    <span class="badge-approved"><i class="bi bi-check-circle"></i> Approved</span>
                                @else
                                    <span class="badge-rejected"><i class="bi bi-x-circle"></i> Rejected</span>
                                @endif
                            </td>
                            <td class="text-slate-500">{{ $post->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('user.posts.show', $post) }}" class="btn-outline btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('user.posts.edit', $post) }}" class="btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="flex flex-col items-center justify-center py-12 text-center">
                                    <span class="grid h-14 w-14 place-items-center rounded-full bg-slate-100 text-2xl text-slate-400">
                                        <i class="bi bi-inbox"></i>
                                    </span>
                                    <p class="mt-3 text-sm text-slate-500">
                                        Belum ada postingan.
                                        <a href="{{ route('user.posts.create') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">Buat pertama!</a>
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

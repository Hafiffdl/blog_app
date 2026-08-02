@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Ringkasan aktivitas konten')

@section('content')
    {{-- Kartu statistik --}}
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="card flex items-center gap-4 p-5">
            <span class="grid h-12 w-12 place-items-center rounded-xl bg-primary-50 text-primary-600">
                <i class="bi bi-file-earmark-text text-xl"></i>
            </span>
            <div>
                <p class="text-2xl font-bold text-slate-900">{{ number_format($totalPosts) }}</p>
                <p class="text-sm text-slate-500">Total Posts</p>
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
            <span class="grid h-12 w-12 place-items-center rounded-xl bg-emerald-50 text-emerald-600">
                <i class="bi bi-check-circle text-xl"></i>
            </span>
            <div>
                <p class="text-2xl font-bold text-slate-900">{{ number_format($approvedPosts) }}</p>
                <p class="text-sm text-slate-500">Telah Disetujui</p>
            </div>
        </div>

        <div class="card flex items-center gap-4 p-5">
            <span class="grid h-12 w-12 place-items-center rounded-xl bg-sky-50 text-sky-600">
                <i class="bi bi-people text-xl"></i>
            </span>
            <div>
                <p class="text-2xl font-bold text-slate-900">{{ number_format($totalUsers) }}</p>
                <p class="text-sm text-slate-500">Total Pengguna</p>
            </div>
        </div>
    </div>

    {{-- Postingan terbaru --}}
    <div class="card mt-6">
        <div class="card-header">
            <h3 class="text-base font-bold text-slate-900">Postingan Terbaru</h3>
            <a href="{{ route('admin.posts.index') }}" class="btn-outline btn-sm">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Dibuat</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentPosts as $post)
                        <tr>
                            <td class="max-w-xs">
                                <span class="block truncate font-medium text-slate-900">{{ $post->title }}</span>
                            </td>
                            <td class="text-slate-600">{{ $post->user->name }}</td>
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
                                    <a href="{{ route('admin.posts.show', $post) }}" class="btn-outline btn-sm" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if($post->status === 'pending')
                                        <form method="POST" action="{{ route('admin.posts.approve', $post) }}">
                                            @csrf
                                            <button type="submit" class="btn-success btn-sm" title="Setujui">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-10 text-center text-slate-500">Belum ada postingan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

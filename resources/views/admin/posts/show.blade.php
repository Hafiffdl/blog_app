@extends('admin.layout')

@section('title', 'Lihat Post')
@section('page-title', 'Detail Postingan')
@section('page-description', 'Pratinjau dan tinjauan postingan')

@section('content')
    <div class="mx-auto max-w-4xl">
        <div class="card overflow-hidden">
            <div class="border-b border-slate-200 bg-gradient-to-r from-primary-600 to-indigo-600 px-8 py-8">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <h2 class="text-xl font-bold text-white">{{ $post->title }}</h2>
                    @if($post->status === 'pending')
                        <span class="badge-pending"><i class="bi bi-clock"></i> Pending</span>
                    @elseif($post->status === 'approved')
                        <span class="badge-approved"><i class="bi bi-check-circle"></i> Approved</span>
                    @else
                        <span class="badge-rejected"><i class="bi bi-x-circle"></i> Rejected</span>
                    @endif
                </div>
            </div>

            <div class="p-8">
                <dl class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-lg bg-slate-50 p-4">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Penulis</dt>
                        <dd class="mt-1 font-medium text-slate-900">{{ $post->user->name }}</dd>
                    </div>
                    <div class="rounded-lg bg-slate-50 p-4">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Dibuat</dt>
                        <dd class="mt-1 font-medium text-slate-900">{{ $post->created_at->format('d F Y, H:i') }}</dd>
                    </div>
                    <div class="rounded-lg bg-slate-50 p-4">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Diperbarui</dt>
                        <dd class="mt-1 font-medium text-slate-900">{{ $post->updated_at->format('d F Y, H:i') }}</dd>
                    </div>
                    <div class="rounded-lg bg-slate-50 p-4">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Status</dt>
                        <dd class="mt-1">
                            @if($post->status === 'pending')
                                <span class="badge-pending">Pending</span>
                            @elseif($post->status === 'approved')
                                <span class="badge-approved">Approved</span>
                            @else
                                <span class="badge-rejected">Rejected</span>
                            @endif
                        </dd>
                    </div>
                </dl>

                <div class="mt-8 border-t border-slate-200 pt-6">
                    <h4 class="mb-3 text-sm font-bold text-slate-900">Isi Konten</h4>
                    <div class="whitespace-pre-wrap rounded-lg border border-slate-200 bg-slate-50 p-6 leading-relaxed text-slate-700">
                        {{ $post->content }}
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3 border-t border-slate-200 px-8 py-5">
                <a href="{{ route('admin.posts.index') }}" class="btn-outline btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('admin.posts.edit', $post) }}" class="btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
                @if($post->status === 'pending')
                    <form method="POST" action="{{ route('admin.posts.approve', $post) }}" class="inline">
                        @csrf
                        <button type="submit" class="btn-success btn-sm">
                            <i class="bi bi-check-lg"></i> Setujui
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.posts.reject', $post) }}" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-sm border border-amber-300 bg-amber-50 text-amber-700 hover:bg-amber-100 focus:ring-amber-400">
                            <i class="bi bi-x-lg"></i> Tolak
                        </button>
                    </form>
                @endif
                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" class="inline" data-confirm="Yakin ingin menghapus postingan ini?">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger btn-sm">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

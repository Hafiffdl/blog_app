@extends('user.layout')

@section('title', 'Postingan Saya')
@section('page-title', 'Postingan Saya')
@section('page-description', 'Kelola artikel kamu')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="text-base font-bold text-slate-900">Semua Postingan Saya</h3>
            <a href="{{ route('user.posts.create') }}" class="btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i> Buat Postingan
            </a>
        </div>

        @if($posts->count() > 0)
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
                        @foreach($posts as $post)
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
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <a href="{{ route('user.posts.show', $post) }}" class="btn-outline btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('user.posts.edit', $post) }}" class="btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form method="POST" action="{{ route('user.posts.destroy', $post) }}" data-confirm="Yakin ingin menghapus postingan ini?">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-center border-t border-slate-200 px-6 py-4">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @else
            <div class="flex flex-col items-center justify-center p-16 text-center">
                <span class="grid h-16 w-16 place-items-center rounded-full bg-slate-100 text-3xl text-slate-400">
                    <i class="bi bi-inbox"></i>
                </span>
                <h3 class="mt-4 text-lg font-bold text-slate-900">Belum Ada Postingan</h3>
                <p class="mt-1 text-sm text-slate-500">Kamu belum membuat postingan apa pun.</p>
                <a href="{{ route('user.posts.create') }}" class="btn-primary mt-5">
                    <i class="bi bi-plus-lg"></i> Buat Postingan Pertama
                </a>
            </div>
        @endif
    </div>
@endsection

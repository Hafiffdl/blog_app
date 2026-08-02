@extends('admin.layout')

@section('title', 'Kelola Posts')
@section('page-title', 'Pelaporan')
@section('page-description', 'Kelola seluruh postingan pengguna')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="text-base font-bold text-slate-900">Semua Postingan</h3>
            <div class="text-sm text-slate-500">{{ $posts->total() }} postingan</div>
        </div>

        @if($posts->count() > 0)
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Status</th>
                            <th>Dibuat</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td class="text-slate-500">{{ $posts->firstItem() + $loop->index }}</td>
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
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <a href="{{ route('admin.posts.show', $post) }}" class="btn-outline btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        @if($post->status === 'pending')
                                            <form method="POST" action="{{ route('admin.posts.approve', $post) }}">
                                                @csrf
                                                <button type="submit" class="btn-success btn-sm">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.posts.reject', $post) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-sm border border-amber-300 bg-amber-50 text-amber-700 hover:bg-amber-100 focus:ring-amber-400">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" data-confirm="Yakin ingin menghapus postingan ini?">
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
                <p class="mt-1 text-sm text-slate-500">Belum ada postingan yang masuk.</p>
            </div>
        @endif
    </div>
@endsection

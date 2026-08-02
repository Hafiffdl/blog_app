@extends('layouts.app')

@section('title', 'Permohonan Saya')

@section('content')
    <div class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Permohonan KI Saya</h1>
                <p class="mt-1 text-slate-500">Kelola semua permohonan kekayaan intelektual yang telah kamu ajukan.</p>
            </div>
            <a href="{{ route('ki.index') }}" class="btn-primary">
                <i class="bi bi-plus-lg"></i> Ajukan Permohonan Baru
            </a>
        </div>

        @if(session('success'))
            <div class="mt-6 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800">
                <i class="bi bi-check-circle-fill mt-0.5 text-emerald-500"></i>
                <div class="flex-1">{{ session('success') }}</div>
                <button type="button" class="text-emerald-400 hover:text-emerald-600" onclick="this.parentElement.remove()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="mt-6 flex items-start gap-3 rounded-lg border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800">
                <i class="bi bi-exclamation-circle-fill mt-0.5 text-rose-500"></i>
                <div class="flex-1">{{ session('error') }}</div>
                <button type="button" class="text-rose-400 hover:text-rose-600" onclick="this.parentElement.remove()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        @endif

        <div class="card mt-8">
            @if($usulan->count() > 0)
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis KI</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usulan as $index => $item)
                                <tr>
                                    <td class="text-slate-500">{{ $usulan->firstItem() + $index }}</td>
                                    <td class="font-medium text-slate-900">{{ $item->mstKi->nama }}</td>
                                    <td class="text-slate-700">{{ $item->judul }}</td>
                                    <td class="text-slate-500">{{ $item->tanggal->format('d/m/Y') }}</td>
                                    <td>
                                        @if($item->status === 'pending')
                                            <span class="badge-pending"><i class="bi bi-clock"></i> Pending</span>
                                        @elseif($item->status === 'approved')
                                            <span class="badge-approved"><i class="bi bi-check-circle"></i> Disetujui</span>
                                        @else
                                            <span class="badge-rejected"><i class="bi bi-x-circle"></i> Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex justify-end gap-2">
                                            <button type="button" class="btn-outline btn-sm" onclick="viewDetail({{ $item->id }})">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            @if($item->status === 'pending')
                                                <a href="{{ route('ki.edit', $item->id) }}" class="btn-warning btn-sm">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button type="button" class="btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-wrap items-center justify-between gap-4 border-t border-slate-200 px-6 py-4">
                    <p class="text-sm text-slate-500">
                        Menampilkan {{ $usulan->firstItem() }} sampai {{ $usulan->lastItem() }} dari {{ $usulan->total() }} permohonan
                    </p>
                    <div>
                        {{ $usulan->links('pagination::tailwind') }}
                    </div>
                </div>
            @else
                <div class="flex flex-col items-center justify-center p-16 text-center">
                    <span class="grid h-16 w-16 place-items-center rounded-full bg-slate-100 text-3xl text-slate-400">
                        <i class="bi bi-inbox"></i>
                    </span>
                    <h3 class="mt-4 text-lg font-bold text-slate-900">Belum Ada Permohonan</h3>
                    <p class="mt-1 text-sm text-slate-500">Kamu belum mengajukan permohonan KI apa pun.</p>
                    <a href="{{ route('ki.index') }}" class="btn-primary mt-5">
                        <i class="bi bi-plus-lg"></i> Ajukan Permohonan Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    @foreach($usulan as $item)
        <form id="delete-form-{{ $item->id }}" action="{{ route('ki.destroy', $item->id) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

    @push('scripts')
    <script>
        function viewDetail(id) {
            alert('Detail ID: ' + id);
        }

        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus permohonan ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
    @endpush
@endsection

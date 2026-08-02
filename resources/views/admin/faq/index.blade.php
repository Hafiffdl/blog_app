@extends('admin.layout')

@section('title', 'Kelola FAQ')
@section('page-title', 'FAQ')
@section('page-description', 'Kelola pertanyaan yang sering diajukan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="text-base font-bold text-slate-900">Daftar FAQ</h3>
            <div class="flex items-center gap-2">
                <input type="text" class="form-control !w-52" placeholder="Cari..." id="searchInput">
                <button type="button" class="btn-primary" id="btnTambahFaq">
                    <i class="bi bi-plus-lg"></i> Tambah Baru
                </button>
            </div>
        </div>

        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th>Dibuat Pada</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $index => $faq)
                        <tr class="faq-row">
                            <td class="text-slate-500">{{ $faqs->firstItem() + $index }}</td>
                            <td class="max-w-xs">
                                <span class="block font-medium text-slate-900 line-clamp-2">{{ $faq->pertanyaan }}</span>
                            </td>
                            <td class="max-w-sm">
                                <span class="block text-slate-600 line-clamp-2">{{ $faq->jawaban }}</span>
                            </td>
                            <td class="whitespace-nowrap text-slate-500">{{ $faq->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="flex justify-center gap-2">
                                    @if(!$faq->deleted_at)
                                        <button type="button" class="btn-outline btn-sm" title="Edit"
                                                onclick="openEditModal({{ $faq->id }}, '{{ addslashes($faq->pertanyaan) }}', '{{ addslashes($faq->jawaban) }}')">
                                            <i class="bi bi-pencil-square text-amber-500"></i>
                                        </button>
                                        <button type="button" class="btn-danger btn-sm" title="Hapus" onclick="confirmDelete({{ $faq->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @else
                                        <span class="badge-rejected">Dihapus</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="flex flex-col items-center justify-center py-16 text-center">
                                    <span class="grid h-16 w-16 place-items-center rounded-full bg-slate-100 text-3xl text-slate-400">
                                        <i class="bi bi-question-circle"></i>
                                    </span>
                                    <p class="mt-4 text-sm text-slate-500">Belum ada FAQ</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($faqs->count() > 0)
            <div class="flex justify-end border-t border-slate-200 px-6 py-4">
                {{ $faqs->links('pagination::tailwind') }}
            </div>
        @endif
    </div>

    @include('admin.faq.create')
    @include('admin.faq.edit')

    <form id="formDelete" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
    <script>
        document.getElementById('btnTambahFaq').addEventListener('click', function() {
            document.getElementById('modalTambah').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = 'none';
            document.body.style.overflow = '';

            if (modalId === 'modalTambah') {
                document.getElementById('formTambahFaq').reset();
            } else if (modalId === 'modalEdit') {
                document.getElementById('formEditFaq').reset();
            }
        }

        function openEditModal(id, pertanyaan, jawaban) {
            const modal = document.getElementById('modalEdit');
            const form = document.getElementById('formEditFaq');

            form.action = `/admin/faqs/${id}`;
            document.getElementById('pertanyaan_edit').value = pertanyaan;
            document.getElementById('jawaban_edit').value = jawaban;

            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus FAQ ini?')) {
                const form = document.getElementById('formDelete');
                form.action = `/admin/faqs/${id}`;
                form.submit();
            }
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal('modalTambah');
                closeModal('modalEdit');
            }
        });

        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('.faq-row').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
            });
        });

        document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) {
                    closeModal(overlay.id);
                }
            });
        });
    </script>
    @endpush
@endsection

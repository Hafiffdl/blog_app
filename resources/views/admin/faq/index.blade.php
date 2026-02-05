@extends('layouts.vuexy-admin')

@section('title', 'Manage FAQs')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Page Header -->
        <div class="page-header-box" style="background: #dc3545; padding: 0.75rem 1.5rem; border-radius: 8px 8px 0 0; border-bottom: 1px solid #e7e7e7;">
            <h6 style="margin: 0; color: #6c757d; font-size: 0.875rem; font-weight: 500;">FAQ</h6>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 1rem; border-radius: 8px; background-color: #d4edda; border-color: #c3e6cb; color: #155724;">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 1rem; border-radius: 8px;">
                <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="card" style="border-radius: 0 0 8px 8px; margin-top: 0;">
            <!-- Card Header with Title and Actions -->
            <div class="card-header" style="background: white; border-bottom: 1px solid #e7e7e7; padding: 1.5rem;">
                <h5 style="margin: 0 0 1rem 0; font-size: 1.125rem; font-weight: 600; color: #2c3e50;">Frequently Asked Questions</h5>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3" style="flex: 1;">
                        <input type="text" class="form-control" placeholder="Cari" style="max-width: 300px; border-radius: 6px; border: 1px solid #ddd;" id="searchInput">
                    </div>
                    <button type="button" class="btn btn-gradient" id="btnTambahFaq">
                        <i class="bi bi-plus"></i> Tambah Baru
                    </button>
                </div>
            </div>
            
            <div class="card-body" style="padding: 0;">
                <div class="table-responsive">
                    <table class="table" style="margin-bottom: 0; table-layout: fixed;">
                        <thead style="background: #f8f9fa;">
                            <tr>
                                <th width="5%" style="padding: 1rem; font-weight: 600; color: #6c757d; text-transform: uppercase; font-size: 0.75rem; border-bottom: 2px solid #e7e7e7;">NO</th>
                                <th width="25%" style="padding: 1rem; font-weight: 600; color: #6c757d; text-transform: uppercase; font-size: 0.75rem; border-bottom: 2px solid #e7e7e7;">PERTANYAAN</th>
                                <th width="35%" style="padding: 1rem; font-weight: 600; color: #6c757d; text-transform: uppercase; font-size: 0.75rem; border-bottom: 2px solid #e7e7e7;">JAWABAN</th>
                                <th width="15%" style="padding: 1rem; font-weight: 600; color: #6c757d; text-transform: uppercase; font-size: 0.75rem; border-bottom: 2px solid #e7e7e7;">DIBUAT PADA</th>
                                <th width="10%" style="padding: 1rem; font-weight: 600; color: #6c757d; text-transform: uppercase; font-size: 0.75rem; text-align: center; border-bottom: 2px solid #e7e7e7;">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($faqs as $index => $faq)
                                <tr style="border-bottom: 1px solid #e7e7e7;" class="faq-row">
                                    <td style="padding: 1.25rem 1rem; vertical-align: middle; color: #2c3e50;">{{ $faqs->firstItem() + $index }}</td>
                                    <td style="padding: 1.25rem 1rem; vertical-align: middle;">
                                        <div style="color: #2c3e50; font-weight: 500; line-height: 1.6; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">
                                            {{ $faq->pertanyaan }}
                                        </div>
                                    </td>
                                    <td style="padding: 1.25rem 1rem; vertical-align: middle;">
                                        <div style="color: #6c757d; line-height: 1.6; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">
                                            {{ $faq->jawaban }}
                                        </div>
                                    </td>
                                    <td style="padding: 1.25rem 1rem; vertical-align: middle;">
                                        <div style="color: #6c757d; white-space: nowrap;">
                                            {{ $faq->created_at->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td style="padding: 1.25rem 1rem; vertical-align: middle; text-align: center;">
                                        @if(!$faq->deleted_at)
                                            <div class="d-flex gap-2 justify-content-center align-items-center">
                                                <button type="button" class="btn-icon" style="background: none; border: none; color: #ffc107; font-size: 1.25rem; cursor: pointer; padding: 0; line-height: 1;" title="Edit" onclick="openEditModal({{ $faq->id }}, '{{ addslashes($faq->pertanyaan) }}', '{{ addslashes($faq->jawaban) }}')">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button type="button" class="btn-icon" style="background: none; border: none; color: #dc3545; font-size: 1.25rem; cursor: pointer; padding: 0; line-height: 1;" title="Hapus" onclick="confirmDelete({{ $faq->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        @else
                                            <span class="badge bg-danger">Deleted</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center" style="padding: 3rem;">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox" style="font-size: 3rem; color: #dee2e6;"></i>
                                            <p class="mt-3 mb-0">Belum ada FAQ</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if($faqs->count() > 0)
            <div class="card-footer" style="background: white; border-top: 1px solid #e7e7e7; padding: 1rem 1.5rem;">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="pagination-controls d-flex gap-1 align-items-center">
                        {{-- Previous Button --}}
                        @if($faqs->onFirstPage())
                            <button class="btn btn-sm" style="border: 1px solid #dee2e6; background: white; color: #dee2e6; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;" disabled>
                                <i class="bi bi-chevron-double-left"></i>
                            </button>
                            <button class="btn btn-sm" style="border: 1px solid #dee2e6; background: white; color: #dee2e6; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;" disabled>
                                <i class="bi bi-chevron-left"></i>
                            </button>
                        @else
                            <a href="{{ $faqs->url(1) }}" class="btn btn-sm" style="border: 1px solid #dee2e6; background: white; color: #6c757d; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                <i class="bi bi-chevron-double-left"></i>
                            </a>
                            <a href="{{ $faqs->previousPageUrl() }}" class="btn btn-sm" style="border: 1px solid #dee2e6; background: white; color: #6c757d; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        @endif
                        
                        {{-- Page Numbers --}}
                        @php
                            $currentPage = $faqs->currentPage();
                            $lastPage = $faqs->lastPage();
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($lastPage, $currentPage + 2);
                        @endphp
                        
                        @for($i = $startPage; $i <= $endPage; $i++)
                            @if($i == $currentPage)
                                <button class="btn btn-sm" style="border: 1px solid #dc3545; background: #dc3545; color: white; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;">
                                    {{ $i }}
                                </button>
                            @else
                                <a href="{{ $faqs->url($i) }}" class="btn btn-sm" style="border: 1px solid #dee2e6; background: white; color: #6c757d; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                    {{ $i }}
                                </a>
                            @endif
                        @endfor
                        
                        {{-- Next Button --}}
                        @if($faqs->hasMorePages())
                            <a href="{{ $faqs->nextPageUrl() }}" class="btn btn-sm" style="border: 1px solid #dee2e6; background: white; color: #6c757d; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                            <a href="{{ $faqs->url($lastPage) }}" class="btn btn-sm" style="border: 1px solid #dee2e6; background: white; color: #6c757d; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                <i class="bi bi-chevron-double-right"></i>
                            </a>
                        @else
                            <button class="btn btn-sm" style="border: 1px solid #dee2e6; background: white; color: #dee2e6; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;" disabled>
                                <i class="bi bi-chevron-right"></i>
                            </button>
                            <button class="btn btn-sm" style="border: 1px solid #dee2e6; background: white; color: #dee2e6; width: 32px; height: 32px; padding: 0; display: flex; align-items: center; justify-content: center;" disabled>
                                <i class="bi bi-chevron-double-right"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Include Modals -->
@include('admin.faq.create')
@include('admin.faq.edit')

<!-- Form untuk Delete (hidden) -->
<form id="formDelete" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('styles')
<style>
    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .modal-backdrop {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
    }
    
    .modal-container {
        position: relative;
        z-index: 10000;
        width: 100%;
        max-width: 560px;
        margin: 1rem;
    }
    
    .modal-content-box {
        background: white;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        animation: modalSlideIn 0.3s ease;
    }
    
    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .modal-header-custom {
        padding: 1.5rem;
        text-align: center;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .modal-title-custom {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
        color: #2c3e50;
    }
    
    .modal-body-custom {
        padding: 1.5rem;
    }
    
    .modal-footer-custom {
        padding: 1rem 1.5rem 1.5rem;
        display: flex;
        gap: 0.75rem;
        justify-content: center;
    }
    
    .btn-cancel {
        background: #fce4e4;
        color: #c42b2b;
        border: none;
        padding: 0.625rem 2rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .btn-cancel:hover {
        background: #f8d7d7;
    }
    
    .btn-submit {
        background: #dc3545;
        color: white;
        border: none;
        padding: 0.625rem 2rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .btn-submit:hover {
        background: #c82333;
    }
    
    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .form-control:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        outline: none;
    }
    
    .btn-gradient {
        background: linear-gradient(135deg, #dc3545 0%, #b02a37 100%);
        color: white;
        border: none;
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
    }
    
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .btn-icon {
        padding: 0;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-icon:hover {
        transform: scale(1.15);
    }
    
    /* Fix for table overflow */
    .table-responsive {
        overflow-x: auto;
    }
    
    /* Ensure pagination buttons are properly aligned */
    .pagination-controls a,
    .pagination-controls button {
        flex-shrink: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    // Open modal tambah
    document.getElementById('btnTambahFaq').addEventListener('click', function() {
        document.getElementById('modalTambah').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    });

    // Close modal function
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.style.display = 'none';
        document.body.style.overflow = '';
        
        // Reset form
        if (modalId === 'modalTambah') {
            document.getElementById('formTambahFaq').reset();
        } else if (modalId === 'modalEdit') {
            document.getElementById('formEditFaq').reset();
        }
    }

    // Open edit modal
    function openEditModal(id, pertanyaan, jawaban) {
        const modal = document.getElementById('modalEdit');
        const form = document.getElementById('formEditFaq');
        
        // Set form action
        form.action = `/admin/faqs/${id}`;
        
        // Set values
        document.getElementById('pertanyaan_edit').value = pertanyaan;
        document.getElementById('jawaban_edit').value = jawaban;
        
        // Show modal
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    // Confirm delete
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus FAQ ini?')) {
            const form = document.getElementById('formDelete');
            form.action = `/admin/faqs/${id}`;
            form.submit();
        }
    }

    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('modalTambah');
            closeModal('modalEdit');
        }
    });

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('.faq-row');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Auto hide success alert
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            if (alert) {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 150);
            }
        });
    }, 3000);
</script>
@endpush
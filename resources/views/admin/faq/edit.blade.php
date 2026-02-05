<!-- Modal Edit FAQ -->
<div class="modal-overlay" id="modalEdit" style="display: none;">
    <div class="modal-backdrop" onclick="closeModal('modalEdit')"></div>
    <div class="modal-container">
        <div class="modal-content-box">
            <div class="modal-header-custom">
                <h5 class="modal-title-custom">Edit FAQ</h5>
            </div>
            <form id="formEditFaq" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body-custom">
                    <div class="form-group mb-4">
                        <label for="pertanyaan_edit" class="form-label">Pertanyaan</label>
                        <textarea 
                            class="form-control" 
                            id="pertanyaan_edit" 
                            name="pertanyaan" 
                            rows="4" 
                            required
                            placeholder="Masukkan pertanyaan FAQ..."
                            style="resize: vertical; border-radius: 8px; border: 1px solid #e0e0e0; padding: 0.75rem;"
                        ></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jawaban_edit" class="form-label">Jawaban</label>
                        <textarea 
                            class="form-control" 
                            id="jawaban_edit" 
                            name="jawaban" 
                            rows="4" 
                            required
                            placeholder="Masukkan jawaban FAQ..."
                            style="resize: vertical; border-radius: 8px; border: 1px solid #e0e0e0; padding: 0.75rem;"
                        ></textarea>
                    </div>
                </div>
                <div class="modal-footer-custom">
                    <button type="button" class="btn btn-cancel" onclick="closeModal('modalEdit')">Batal</button>
                    <button type="submit" class="btn btn-submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.15rem rgba(220, 53, 69, 0.1);
        outline: none;
    }
    
    .btn:hover {
        opacity: 0.9;
        transform: translateY(-1px);
        transition: all 0.2s;
    }
    
    .modal-backdrop {
        background-color: rgba(0, 0, 0, 0.6);
    }
</style>
{{-- Modal Edit FAQ --}}
<div class="modal-overlay fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4" id="modalEdit">
    <div class="modal-content-box w-full max-w-lg rounded-xl bg-white shadow-xl">
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
            <h5 class="text-base font-bold text-slate-900">Edit FAQ</h5>
            <button type="button" class="text-slate-400 hover:text-slate-600" onclick="closeModal('modalEdit')">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <form id="formEditFaq" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4 p-6">
                <div>
                    <label for="pertanyaan_edit" class="form-label">Pertanyaan</label>
                    <textarea class="form-control" id="pertanyaan_edit" name="pertanyaan" rows="3"
                              required placeholder="Masukkan pertanyaan FAQ..."></textarea>
                </div>
                <div>
                    <label for="jawaban_edit" class="form-label">Jawaban</label>
                    <textarea class="form-control" id="jawaban_edit" name="jawaban" rows="4"
                              required placeholder="Masukkan jawaban FAQ..."></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-3 border-t border-slate-200 px-6 py-4">
                <button type="button" class="btn-outline" onclick="closeModal('modalEdit')">Batal</button>
                <button type="submit" class="btn-primary">
                    <i class="bi bi-check-lg"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

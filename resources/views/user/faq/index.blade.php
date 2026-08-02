@extends('user.layout')

@section('title', 'FAQ')
@section('page-title', 'Frequently Asked Questions')
@section('page-description', 'Temukan jawaban atas pertanyaan yang sering diajukan')

@section('content')
    <div class="mx-auto max-w-3xl">
        @if($faqs->count() > 0)
            <div class="card">
                <div class="card-header">
                    <div class="flex items-center gap-2 text-emerald-600">
                        <i class="bi bi-search"></i>
                        <input type="text" class="form-control" id="faqSearch" placeholder="Cari pertanyaan...">
                    </div>
                </div>
                <div class="card-body !p-0">
                    <div class="divide-y divide-slate-100" id="faqList">
                        @foreach($faqs as $faq)
                            <div class="faq-item">
                                <button class="faq-question flex w-full items-center justify-between gap-3 px-6 py-4 text-left transition-colors hover:bg-slate-50" onclick="toggleFaq(this)">
                                    <span class="font-medium text-slate-800">{{ $faq->pertanyaan }}</span>
                                    <span class="faq-icon-toggle text-slate-400 transition-transform duration-200">
                                        <i class="bi bi-chevron-down"></i>
                                    </span>
                                </button>
                                <div class="faq-answer hidden">
                                    <div class="border-l-4 border-emerald-500 bg-emerald-50/50 px-6 py-4 text-sm leading-relaxed text-slate-600">
                                        {{ $faq->jawaban }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="card flex flex-col items-center justify-center p-16 text-center">
                <span class="grid h-16 w-16 place-items-center rounded-full bg-slate-100 text-3xl text-slate-400">
                    <i class="bi bi-question-circle"></i>
                </span>
                <h4 class="mt-4 text-lg font-bold text-slate-900">Belum Ada FAQ</h4>
                <p class="mt-1 text-sm text-slate-500">Saat ini belum ada FAQ yang tersedia.</p>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    function toggleFaq(button) {
        const answer = button.nextElementSibling;
        const isActive = button.querySelector('.faq-icon-toggle').classList.contains('rotate-180');

        document.querySelectorAll('.faq-question').forEach(q => {
            q.querySelector('.faq-icon-toggle').classList.remove('rotate-180');
            q.classList.remove('text-emerald-600');
            q.nextElementSibling.classList.add('hidden');
        });

        if (!isActive) {
            button.querySelector('.faq-icon-toggle').classList.add('rotate-180');
            button.classList.add('text-emerald-600');
            answer.classList.remove('hidden');
        }
    }

    document.getElementById('faqSearch')?.addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.faq-item').forEach(item => {
            item.style.display = item.textContent.toLowerCase().includes(term) ? '' : 'none';
        });
    });
</script>
@endpush

@extends('layouts.vuexy-user')

@section('title', 'FAQ')

@section('page-title', 'Frequently Asked Questions')

@push('styles')
<style>
    .faq-container {
        max-width: 900px;
        margin: 0 auto;
    }
    
    .faq-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    
    .faq-header h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }
    
    .faq-header p {
        color: #6c757d;
        font-size: 1rem;
    }
    
    .faq-search {
        margin-bottom: 2rem;
    }
    
    .faq-search input {
        border-radius: 8px;
        padding: 0.875rem 1.5rem;
        border: 1px solid #e7e7e7;
        font-size: 0.9375rem;
    }
    
    .faq-search input:focus {
        border-color: #28c76f;
        box-shadow: 0 0 0 3px rgba(40, 199, 111, 0.1);
        outline: none;
    }

    .faq-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .faq-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .faq-item {
        background: white;
        border: 1px solid #e7e7e7;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s;
    }
    
    .faq-item:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    
    .faq-question {
        padding: 1rem 1.25rem;
        cursor: pointer;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        background: white;
        border: none;
        width: 100%;
        text-align: left;
        font-weight: 500;
        color: #4b465c;
        font-size: 0.9375rem;
        transition: all 0.3s;
        gap: 0.75rem;
    }
    
    .faq-question:hover {
        background: #f8f9fa;
    }
    
    .faq-question.active {
        background: white;
        color: #dc3545;
        border-bottom: 1px solid #e7e7e7;
    }
    
    .faq-question-text {
        flex: 1;
        line-height: 1.5;
    }
    
    .faq-icon-toggle {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s;
        font-size: 1.25rem;
    }
    
    .faq-question.active .faq-icon-toggle {
        transform: rotate(180deg);
    }
    
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
        background: #f8f9fa;
    }
    0px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s;
        font-size: 1rem;
        color: #6c757d;
        flex-shrink: 0;
        margin-top: 2px;
    }
    
    .faq-question.active .faq-icon-toggle {
        transform: rotate(180deg);
        color: #dc3545;
    }
    
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease;
        background: white;
    }
    
    .faq-answer.show {
        max-height: 1000px;
    }
    
    .faq-answer-content {
        padding: 1rem 1.25rem 1.5rem;
        color: #6c757d;
        line-height: 1.7;
        white-space: pre-line;
        font-size: 0.9375rem;
        border-left: 3px solid #dc3545;
        margin-left: 1.25rem;
        margin-right: 1.25rem;
        margin-bottom: 1rem;
        padding-left: 1rem
        color: #a5a3ae;
    }
</style>
@endpush

@section('content')
<div class="faq-container">
    <!-- Header -->
    <div class="faq-header">
        <h2>Frequently Asked Questions</h2>
        <p>Temukan jawaban untuk pertanyaan yang sering diajukan</p>
    </div>

    @if($faqs->count() > 0)
        <!-- Search Box -->
        <div class="faq-search">
            <input type="text" class="form-control" id="faqSearch" placeholder="Cari pertanyaan...">
        </div>

        <!-- FAQ Items in 2 Columns -->
        <div class="faq-grid" id="faqList">
            @foreach($faqs as $index => $faq)
                <div class="faq-item" data-faq-item>
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span class="faq-question-text">{{ $faq->pertanyaan }}</span>
                        <span class="faq-icon-toggle">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">{{ $faq->jawaban }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <i class="bi bi-question-circle"></i>
            <h4>Belum Ada FAQ</h4>
            <p>Saat ini belum ada FAQ yang tersedia.</p>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Toggle FAQ
    function toggleFaq(button) {
        const answer = button.nextElementSibling;
        const isActive = button.classList.contains('active');
        
        // Close all other FAQs
        document.querySelectorAll('.faq-question').forEach(q => {
            q.classList.remove('active');
            q.nextElementSibling.classList.remove('show');
        });
        
        // Toggle current FAQ
        if (!isActive) {
            button.classList.add('active');
            answer.classList.add('show');
        }
    }
    
    // Search functionality
    document.getElementById('faqSearch')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const faqItems = document.querySelectorAll('[data-faq-item]');
        
        faqItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
@endpush

@props([
    'type' => 'success', // success, error, info, warning
    'message' => '',
    'dismissible' => true,
    'icon' => null,
    'borderColor' => null,
])

@php
    $colors = [
        'success' => '#19c2a6',
        'error' => '#ff5b5b',
        'info' => '#1ca7ec',
        'warning' => '#ffc107',
    ];
    $icons = [
        'success' => 'bi bi-check-circle',
        'error' => 'bi bi-x-octagon',
        'info' => 'bi bi-info-circle',
        'warning' => 'bi bi-exclamation-triangle',
    ];
    $color = $borderColor ?? ($colors[$type] ?? '#19c2a6');
    $iconClass = $icon ?? ($icons[$type] ?? 'bi bi-info-circle');
@endphp

<div class="custom-alert-component" style="
    display: flex;
    align-items: center;
    background: #fff;
    color: #444;
    border-radius: 10px;
    box-shadow: 0 2px 12px 0 rgba(60,72,88,.15);
    border-left: 5px solid {{ $color }};
    padding: 1rem 1.5rem;
    min-width: 320px;
    max-width: 400px;
    position: fixed;
    top: 32px;
    right: 32px;
    z-index: 9999;
    margin: 0;
    opacity: 1;
    animation: fadeInAlert 0.5s;
}">
<style>
@keyframes fadeInAlert {
  from { opacity: 0; transform: translateY(-18px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
    <i class="{{ $iconClass }}" style="font-size: 1.6rem; color: {{ $color }}; margin-right: 1rem;"></i>
    <span style="flex:1; font-size: 1rem;">{!! $message !!}</span>
    @if($dismissible)
        <button type="button" onclick="this.closest('.custom-alert-component').style.display='none'" style="background: none; border: none; font-size: 1.3rem; color: #bbb; margin-left: 1rem; cursor: pointer;">
            <span aria-hidden="true">&times;</span>
        </button>
    @endif
</div>

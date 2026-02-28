@props([
    'href' => null,
    'variant' => 'primary',
    'type' => 'button',
])

@php
    $baseClasses = 'cta-button inline-flex items-center justify-center gap-2 rounded-full px-5 py-3 text-sm font-semibold tracking-wide transition duration-300 active:scale-[0.98] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary';
    $variantClasses = [
        'primary' => 'bg-[linear-gradient(135deg,rgba(59,130,246,1),rgba(126,87,255,0.92),rgba(236,72,153,0.85))] text-white shadow-[0_18px_45px_rgba(59,130,246,0.34)] hover:-translate-y-1 hover:shadow-[0_24px_56px_rgba(59,130,246,0.42)]',
        'outline' => 'border border-white/15 bg-[linear-gradient(135deg,rgba(255,255,255,0.07),rgba(255,255,255,0.02))] text-text shadow-[0_12px_28px_rgba(3,7,20,0.2)] hover:-translate-y-1 hover:border-white/25 hover:bg-white/10 hover:shadow-[0_20px_40px_rgba(3,7,20,0.28)]',
        'ghost' => 'text-text hover:bg-white/5',
    ][$variant] ?? 'bg-primary text-white';
    $classes = $baseClasses.' '.$variantClasses;
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif

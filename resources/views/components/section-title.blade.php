@props([
    'eyebrow' => null,
    'title' => '',
    'description' => null,
    'align' => 'left',
])

@php
    $alignment = $align === 'center' ? 'mx-auto max-w-3xl text-center' : 'max-w-3xl';
@endphp

<div {{ $attributes->merge(['class' => $alignment]) }}>
    @if ($eyebrow)
        <p class="mb-3 inline-flex rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-primary">
            {{ $eyebrow }}
        </p>
    @endif

    <h2 class="font-display text-[clamp(1.6rem,2.6vw,2.2rem)] font-extrabold tracking-tight text-text">
        {{ $title }}
    </h2>

    @if ($description)
        <p class="mt-4 text-base leading-7 text-muted">
            {{ $description }}
        </p>
    @endif
</div>

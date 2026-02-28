@props([
    'item' => [],
    'index' => 0,
])

@php
    $buttonId = 'faq-trigger-'.$index;
    $panelId = 'faq-panel-'.$index;
@endphp

<article class="panel overflow-hidden" data-animate-item>
    <h3>
        <button
            id="{{ $buttonId }}"
            type="button"
            class="faq-trigger flex w-full items-center justify-between gap-4 px-5 py-5 text-left text-base font-semibold text-text"
            data-faq-trigger
            aria-expanded="false"
            aria-controls="{{ $panelId }}"
        >
            <span>{{ $item['question'] }}</span>
            <span class="faq-plus text-xl leading-none text-primary" aria-hidden="true">+</span>
        </button>
    </h3>

    <div
        id="{{ $panelId }}"
        class="faq-panel px-5"
        data-faq-panel
        role="region"
        aria-labelledby="{{ $buttonId }}"
        hidden
    >
        <p class="pb-5 text-sm leading-7 text-muted">{{ $item['answer'] }}</p>
    </div>
</article>

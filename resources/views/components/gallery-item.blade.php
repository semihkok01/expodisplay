@props([
    'item' => [],
    'index' => 0,
])

<article class="gallery-card panel group h-full overflow-hidden js-tilt" data-animate-item>
    <div class="flex h-full w-full flex-col text-left" aria-label="{{ $item['caption'] }}">
        <div class="relative overflow-hidden">
            <img
                src="{{ $item['src'] }}"
                alt="{{ $item['caption'] }}"
                width="{{ $item['width'] }}"
                height="{{ $item['height'] }}"
                loading="lazy"
                class="gallery-image h-64 w-full object-cover transition duration-500"
            >
            <div class="gallery-overlay absolute inset-0 bg-[linear-gradient(180deg,rgba(4,8,20,0)_15%,rgba(4,8,20,0.2)_40%,rgba(4,8,20,0.82)_100%)]"></div>
            <span class="absolute left-4 top-4 rounded-full border border-white/10 bg-black/30 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.2em] text-white/90">
                {{ $item['tag'] }}
            </span>
        </div>

        <div class="flex flex-1 flex-col gap-3 p-5">
            <p class="text-sm font-semibold text-text">{{ $item['caption'] }}</p>
            <p class="text-sm text-muted">Premium Screen-Design, optimiert für hohe Aufmerksamkeit und klare Markenwirkung.</p>
        </div>
    </div>
</article>

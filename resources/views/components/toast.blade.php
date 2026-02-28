@props([
    'message' => '',
])

<div
    class="toast-panel fixed bottom-5 right-5 z-[80] max-w-sm rounded-2xl border border-white/10 bg-surface px-5 py-4 text-sm text-text shadow-[0_14px_50px_rgba(5,10,25,0.45)]"
    role="status"
    aria-live="polite"
    data-toast
>
    <div class="flex items-start gap-3">
        <span class="mt-1 inline-flex h-2.5 w-2.5 rounded-full bg-secondary shadow-[0_0_12px_rgba(34,197,94,0.6)]"></span>
        <p>{{ $message }}</p>
    </div>
</div>

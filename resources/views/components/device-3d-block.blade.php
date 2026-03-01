<section id="device-3d" class="section-space pt-0">
    <div class="mx-auto max-w-6xl px-5 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-12 lg:items-center">
            <div class="lg:col-span-7">
                <div class="device-viewer-shell panel overflow-hidden p-3 sm:p-4">
                    <div
                        class="device-viewer-stage min-h-[320px] rounded-3xl border border-white/10 bg-white/[0.03] shadow-[0_16px_40px_rgba(5,10,25,0.24)] md:min-h-[360px] lg:min-h-[420px]"
                        data-device-viewer
                    >
                        <canvas class="block h-full w-full" data-device-canvas aria-label="{{ __('home.device.aria') }}"></canvas>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="panel p-6 md:p-8">
                    <p class="mb-3 inline-flex rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-primary">
                        {{ __('home.device.eyebrow') }}
                    </p>
                    <h2 class="font-display text-[1.4rem] font-extrabold tracking-tight text-text md:text-[clamp(1.6rem,2.6vw,2.2rem)]">
                        {{ __('home.device.title') }}
                    </h2>
                    <p class="mt-3 text-base leading-7 text-muted">
                        {{ __('home.device.description') }}
                    </p>

                    <div class="mt-6 rounded-3xl border border-white/10 bg-surface-2 p-5">
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-primary">{{ __('home.device.dimensions_title') }}</p>
                        <dl class="mt-4 space-y-3">
                            @foreach (trans('home.device.dimensions') as $dimension)
                                <div class="flex items-center justify-between gap-4 text-sm">
                                    <dt class="text-muted">{{ $dimension['label'] }}</dt>
                                    <dd class="font-semibold text-text">{{ $dimension['value'] }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>

                    <p class="mt-5 text-sm leading-7 text-muted">
                        {{ __('home.device.summary') }}
                    </p>

                    <div class="mt-6">
                        <x-button href="#contact" data-scroll-to>{{ __('common.cta.demo') }}</x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

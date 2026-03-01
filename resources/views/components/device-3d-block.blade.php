<section id="device-3d" class="section-space pt-0">
    <div class="mx-auto max-w-6xl px-5 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 lg:items-center lg:gap-8">
            <div class="lg:col-span-7">
                <div class="device-viewer-shell panel overflow-hidden p-3 sm:p-4">
                    <div
                        id="kiosk3dWrap"
                        class="device-viewer-stage relative min-h-[280px] w-full overflow-hidden rounded-3xl border border-white/10 bg-white/[0.03] shadow-[inset_0_1px_0_rgba(255,255,255,0.03),0_16px_40px_rgba(5,10,25,0.24)] sm:min-h-[320px] md:min-h-[360px] lg:min-h-[400px]"
                    >
                        <span class="pointer-events-none absolute left-4 top-4 z-[2] rounded-full border border-white/10 bg-[rgba(11,16,32,0.7)] px-3 py-1 text-[11px] font-medium tracking-[0.08em] text-white/72">
                            {{ __('home.device.hint') }}
                        </span>
                        <canvas id="kiosk3dCanvas" class="block h-full min-h-[280px] w-full sm:min-h-[320px] md:min-h-[360px] lg:min-h-[400px]" aria-label="{{ __('home.device.aria') }}"></canvas>
                        <div id="kiosk3dFallback" class="absolute inset-0 hidden items-center justify-center px-6 text-center text-sm text-white/72">
                            {{ __('home.device.fallback') }}
                        </div>
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

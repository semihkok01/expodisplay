<section id="device-3d" class="section-space pt-0">
    <div class="mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">
        <div class="panel p-6 md:p-8">
            <p class="mb-3 inline-flex rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-primary">
                {{ __('home.device.eyebrow') }}
            </p>
            <h2 class="font-display text-[1.4rem] font-extrabold tracking-tight text-text md:text-[clamp(1.6rem,2.6vw,2.2rem)]">
                {{ __('home.device.title') }}
            </h2>
            <p class="mt-3 max-w-3xl text-base leading-7 text-muted">
                {{ __('home.device.description') }}
            </p>

            <div class="mt-6 rounded-3xl border border-white/10 bg-surface-2 p-5 md:p-6">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-primary">{{ __('home.device.dimensions_title') }}</p>
                <dl class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3 sm:gap-5">
                    @foreach (trans('home.device.dimensions') as $dimension)
                        <div class="rounded-2xl border border-white/8 bg-white/[0.02] px-4 py-4 text-center">
                            <dt class="text-sm text-muted">{{ $dimension['label'] }}</dt>
                            <dd class="mt-2 text-lg font-semibold text-text md:text-xl">{{ $dimension['value'] }}</dd>
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
</section>

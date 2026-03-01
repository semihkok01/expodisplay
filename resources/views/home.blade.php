@php
    $activeLocale = app()->getLocale();
    $htmlLang = [
        'de' => 'de-DE',
        'en' => 'en',
        'nl' => 'nl-NL',
        'fr' => 'fr-FR',
        'it' => 'it-IT',
    ][$activeLocale] ?? $activeLocale;
    $cleanCanonicalUrl = url()->current();
    $languageOptions = __('common.language.options');
    $activeLanguage = $languageOptions[$activeLocale] ?? $languageOptions['de'];
    $alternateLocaleCodes = ['de', 'en', 'nl', 'fr', 'it'];
@endphp
<!DOCTYPE html>
<html lang="{{ $htmlLang }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('common.meta.title') }}</title>
    <meta name="description" content="{{ __('common.meta.description') }}">
    <meta property="og:title" content="{{ __('common.meta.title') }}">
    <meta property="og:description" content="{{ __('common.meta.description') }}">
    <meta property="og:image" content="{{ url('/assets/og-placeholder.svg') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta name="twitter:title" content="{{ __('common.meta.title') }}">
    <meta name="twitter:description" content="{{ __('common.meta.description') }}">
    <meta name="twitter:image" content="{{ url('/assets/og-placeholder.svg') }}">
    <link rel="canonical" href="{{ $cleanCanonicalUrl }}">
    @foreach ($alternateLocaleCodes as $localeCode)
        @php
            $hreflang = [
                'de' => 'de-DE',
                'en' => 'en',
                'nl' => 'nl-NL',
                'fr' => 'fr-FR',
                'it' => 'it-IT',
            ][$localeCode];
        @endphp
        <link rel="alternate" hreflang="{{ $hreflang }}" href="{{ request()->fullUrlWithQuery(['lang' => $localeCode]) }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ $cleanCanonicalUrl }}">
    <meta name="theme-color" content="#0B1020">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-bg text-text antialiased">
    <div class="scroll-progress" aria-hidden="true">
        <span data-scroll-progress></span>
    </div>
    <div class="page-shell relative overflow-x-clip">
        <header id="top" class="sticky top-0 z-50 border-b border-white/5 bg-[rgba(11,16,32,0.95)]">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 sm:px-6 lg:px-8">
                <a href="#top" data-scroll-to class="flex shrink-0 flex-col items-center justify-center gap-1 text-center leading-none">
                    <img
                        src="{{ asset('assets/logo/logo160.png') }}"
                        srcset="{{ asset('assets/logo/logo160.png') }} 1x, {{ asset('assets/logo/logo320.png') }} 2x"
                        alt="{{ __('common.brand.name') }}"
                        width="160"
                        height="160"
                        class="site-brand-logo block h-auto w-auto object-contain align-middle"
                        style="height:40px;width:auto;max-width:none"
                        decoding="async"
                        fetchpriority="high"
                    >
                    <span class="font-display text-[9px] font-bold uppercase tracking-[0.26em] text-white/82 sm:text-[10px]">
                        {{ __('common.brand.name') }}
                    </span>
                </a>

                <button
                    type="button"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/10 text-text lg:hidden"
                    aria-expanded="false"
                    aria-controls="mobile-menu"
                    data-menu-toggle
                >
                    <span class="sr-only">{{ __('common.nav.menu') }}</span>
                    <span class="space-y-1.5">
                        <span class="block h-0.5 w-5 bg-current"></span>
                        <span class="block h-0.5 w-5 bg-current"></span>
                        <span class="block h-0.5 w-5 bg-current"></span>
                    </span>
                </button>

                <nav class="hidden items-center gap-2 lg:flex" aria-label="{{ __('common.nav.label') }}">
                    <a href="#top" data-scroll-to class="nav-link">
                        {{ __('common.nav.home') }}
                    </a>
                    @foreach ([
                        'features' => __('common.nav.features'),
                        'audiences' => __('common.nav.audiences'),
                        'gallery' => __('common.nav.gallery'),
                        'references' => __('common.nav.references'),
                        'faq' => __('common.nav.faq'),
                        'contact' => __('common.nav.contact'),
                    ] as $sectionId => $label)
                        <a href="#{{ $sectionId }}" data-scroll-to data-nav-link="{{ $sectionId }}" class="nav-link">
                            {{ $label }}
                        </a>
                    @endforeach
                    <x-button href="#contact" data-scroll-to class="nav-cta ml-2">{{ __('common.cta.demo') }}</x-button>
                    <details class="language-switcher relative ml-2">
                        <summary class="language-switcher-trigger" aria-label="{{ __('common.language.active', ['language' => $activeLanguage['label']]) }}">
                            <span class="flag-badge" aria-hidden="true">{{ $activeLanguage['flag'] }}</span>
                            <span class="language-trigger-code">{{ strtoupper($activeLanguage['code']) }}</span>
                            <svg class="language-trigger-caret" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </summary>
                        <div class="language-switcher-menu">
                            @foreach ($alternateLocaleCodes as $localeCode)
                                @php $option = $languageOptions[$localeCode]; @endphp
                                <a href="{{ route('locale.switch', $localeCode) }}" class="language-switcher-link {{ $localeCode === $activeLocale ? 'is-active' : '' }}" hreflang="{{ $localeCode }}" @if ($localeCode === $activeLocale) aria-current="true" @endif>
                                    <span class="language-link-main">
                                        <span class="flag-badge" aria-hidden="true">{{ $option['flag'] }}</span>
                                        <span>{{ $option['label'] }}</span>
                                    </span>
                                    @if ($localeCode === $activeLocale)
                                        <span class="language-link-check" aria-hidden="true">✓</span>
                                    @else
                                        <span class="language-link-code">{{ strtoupper($option['code']) }}</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </details>
                </nav>
            </div>

            <nav id="mobile-menu" class="mobile-nav hidden border-t border-white/5 lg:hidden" aria-label="{{ __('common.nav.label') }}" aria-hidden="true">
                <div class="mx-auto flex max-w-7xl flex-col gap-2 px-5 py-4 sm:px-6">
                    <a href="#top" data-scroll-to class="nav-link w-full text-left">
                        {{ __('common.nav.home') }}
                    </a>
                    @foreach ([
                        'features' => __('common.nav.features'),
                        'audiences' => __('common.nav.audiences'),
                        'gallery' => __('common.nav.gallery'),
                        'references' => __('common.nav.references'),
                        'faq' => __('common.nav.faq'),
                        'contact' => __('common.nav.contact'),
                    ] as $sectionId => $label)
                        <a href="#{{ $sectionId }}" data-scroll-to data-nav-link="{{ $sectionId }}" class="nav-link w-full text-left">
                            {{ $label }}
                        </a>
                    @endforeach
                    <div class="mt-3 rounded-2xl border border-white/8 bg-white/[0.03] p-3">
                        <p class="mb-3 px-1 text-[11px] font-semibold uppercase tracking-[0.22em] text-white/55">
                            {{ __('common.language.label') }}
                        </p>
                        <div class="grid gap-2 sm:grid-cols-2">
                        @foreach ($alternateLocaleCodes as $localeCode)
                            @php $option = $languageOptions[$localeCode]; @endphp
                            <a href="{{ route('locale.switch', $localeCode) }}" class="language-switcher-link {{ $localeCode === $activeLocale ? 'is-active' : '' }}" hreflang="{{ $localeCode }}" @if ($localeCode === $activeLocale) aria-current="true" @endif>
                                <span class="language-link-main">
                                    <span class="flag-badge" aria-hidden="true">{{ $option['flag'] }}</span>
                                    <span>{{ $option['label'] }}</span>
                                </span>
                                @if ($localeCode === $activeLocale)
                                    <span class="language-link-check" aria-hidden="true">✓</span>
                                @else
                                    <span class="language-link-code">{{ strtoupper($option['code']) }}</span>
                                @endif
                            </a>
                        @endforeach
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <section class="hero-shell relative isolate">
                <div class="hero-glow-layer pointer-events-none absolute inset-0" aria-hidden="true">
                    <div class="hero-glow-core" data-hero-glow></div>
                </div>
                <div class="hero-orb hero-orb-one"></div>
                <div class="hero-orb hero-orb-two"></div>
                <div class="hero-orb hero-orb-three"></div>
                <div class="hero-particles pointer-events-none absolute inset-0" aria-hidden="true">
                    @for ($i = 0; $i < 16; $i++)
                        <span class="hero-particle" style="left: {{ rand(6, 92) }}%; top: {{ rand(10, 88) }}%;"></span>
                    @endfor
                </div>

                <div class="mx-auto grid max-w-7xl gap-6 px-5 pb-14 pt-20 sm:gap-10 sm:px-6 sm:py-20 lg:grid-cols-[1.08fr_0.92fr] lg:gap-12 lg:px-8 lg:py-28">
                    <div class="relative z-10 flex flex-col justify-center">
                        <p class="hero-pill" data-hero-seq>{{ __('home.hero.pill') }}</p>
                        <h1 class="mt-5 max-w-3xl font-display text-[clamp(1.8rem,5vw,2.2rem)] font-extrabold leading-[1.08] tracking-tight md:text-[clamp(2.2rem,4vw,3.6rem)] md:leading-[1.05]" data-hero-seq>
                            {{ __('home.hero.title') }}
                        </h1>
                        <p class="mt-5 max-w-2xl text-base leading-[1.7] text-muted md:mt-6 md:leading-8" data-hero-seq>
                            {{ __('home.hero.subtitle') }}
                        </p>

                        <div class="hero-cta-group mt-7 flex flex-col gap-3 md:mt-8 md:flex-row" data-hero-seq>
                            <x-button href="#contact" data-scroll-to>{{ __('common.cta.demo') }}</x-button>
                            <x-button href="#contact" variant="outline" data-scroll-to>{{ __('common.cta.consultation') }}</x-button>
                        </div>
                        <p class="mt-3 text-sm font-medium text-white/72" data-hero-seq>{{ __('common.cta.microcopy') }}</p>

                        <div class="hero-metrics-grid mt-10 grid gap-4 sm:grid-cols-3" data-hero-seq>
                            @foreach (trans('home.hero.metrics') as $metric)
                                <div class="panel p-4">
                                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-muted">{{ $metric['label'] }}</p>
                                    <p class="mt-2 text-sm font-semibold text-text">{{ $metric['value'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="hero-mockup-wrap relative z-10 flex items-center justify-center" data-hero-seq>
                        <div class="hero-depth js-parallax" data-parallax-speed="22">
                            <div class="tilt-surface js-tilt">
                                <div class="kiosk-frame">
                                    <div class="kiosk-top"></div>
                                    <div class="kiosk-shell">
                                        <div class="kiosk-sensor">
                                            <span class="kiosk-lens"></span>
                                        </div>
                                        <div class="kiosk-screen">
                                            <div class="screen-glow"></div>
                                            <div class="screen-stripe screen-stripe-1" data-kiosk-line></div>
                                            <div class="screen-stripe screen-stripe-2" data-kiosk-line></div>
                                            <div class="screen-banner">
                                                <span class="screen-chip">{{ __('home.hero.kiosk_chip') }}</span>
                                                <strong data-kiosk-text>{{ __('home.hero.kiosk_text') }}</strong>
                                                <span class="screen-meter">
                                                    <i data-kiosk-progress></i>
                                                </span>
                                            </div>
                                            <div class="screen-cards">
                                                <div class="screen-mini-card"></div>
                                                <div class="screen-mini-card screen-mini-card-alt"></div>
                                            </div>
                                        </div>
                                        <div class="kiosk-brand">{{ __('common.brand.device') }}</div>
                                    </div>
                                    <div class="kiosk-shadow"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="features" class="section-space pb-10 sm:pb-14">
                <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
                    <x-section-title
                        :eyebrow="__('home.features.eyebrow')"
                        :title="__('home.features.title')"
                        :description="__('home.features.description')"
                    />

                    <div class="mt-6 grid gap-5 md:grid-cols-2 xl:grid-cols-4 sm:mt-8" data-animate-group>
                        @foreach ($features as $feature)
                            <article class="feature-card panel p-6 js-tilt" data-animate-item>
                                <div class="feature-icon">
                                    @switch($feature['icon'])
                                        @case('spark')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-6 w-6">
                                                <path d="M12 2l1.9 5.1L19 9l-5.1 1.9L12 16l-1.9-5.1L5 9l5.1-1.9L12 2z" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            @break
                                        @case('bolt')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-6 w-6">
                                                <path d="M13 2L6 13h5l-1 9 8-12h-5l0-8z" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            @break
                                        @case('shield')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-6 w-6">
                                                <path d="M12 3l7 3v6c0 4.2-2.7 8-7 9-4.3-1-7-4.8-7-9V6l7-3z" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            @break
                                        @default
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-6 w-6">
                                                <path d="M4 18h16M7 14l3-3 3 2 4-5" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                    @endswitch
                                </div>
                                <h3 class="mt-5 text-lg font-semibold text-text">{{ $feature['title'] }}</h3>
                                <p class="mt-3 text-sm leading-7 text-muted">{{ $feature['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
            <section id="showcase" class="section-space pt-0 pb-12 sm:pb-16">
                <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
                    <x-section-title
                        :eyebrow="__('home.showcase.eyebrow')"
                        :title="__('home.showcase.title')"
                        :description="__('home.showcase.description')"
                        data-animate-item
                    />

                    <div class="mt-4 grid gap-5 lg:grid-cols-3 sm:mt-6 sm:gap-6" data-animate-group data-animate-stagger="150" data-animate-duration="600">
                        @foreach ($showcases as $item)
                            <article class="showcase-card panel overflow-hidden p-5 md:p-6" data-animate-item>
                                <div class="screen-stage js-parallax" data-parallax-speed="16">
                                    <div class="tilt-surface js-tilt" data-tilt-intensity="3">
                                        <div class="strategy-kiosk-frame">
                                            <div class="strategy-kiosk-top"></div>
                                            <div class="strategy-kiosk-shell">
                                                <div class="strategy-kiosk-sensor">
                                                    <span class="strategy-kiosk-lens"></span>
                                                </div>
                                                <div class="strategy-kiosk-screen strategy-kiosk-{{ $item['accent'] }}">
                                                    <div class="strategy-screen-glow"></div>
                                                    <div class="strategy-screen-stripe" data-strategy-line></div>
                                                    <div class="strategy-screen-stripe strategy-screen-stripe-short" data-strategy-line></div>
                                                    <div class="strategy-screen-banner">
                                                        <span class="strategy-screen-chip" aria-hidden="true"></span>
                                                        <span class="strategy-screen-meter">
                                                            <i data-strategy-progress></i>
                                                        </span>
                                                    </div>
                                                    <div class="strategy-screen-bottom">
                                                        <div class="strategy-mini-panel"></div>
                                                        <div class="strategy-mini-panel strategy-mini-panel-alt"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="mt-7 text-xs font-semibold uppercase tracking-[0.24em] text-white/50">{{ $item['eyebrow'] }}</p>
                                <h3 class="mt-3 text-xl font-semibold text-text">{{ $item['title'] }}</h3>
                                <p class="mt-3 text-sm leading-7 text-muted">{{ $item['text'] }}</p>
                                <p class="mt-5 text-sm font-semibold text-primary">{{ $item['result'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="gallery" class="section-space pt-0">
                <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
                    <x-section-title
                        :eyebrow="__('home.gallery.eyebrow')"
                        :title="__('home.gallery.title')"
                        :description="__('home.gallery.description')"
                    />

                    <div class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-4 sm:mt-12 sm:gap-6" data-animate-group>
                        @foreach ($videoShowcaseItems as $item)
                            <article class="video-kiosk-card panel p-4 js-tilt" data-animate-item>
                                <div class="video-kiosk-frame">
                                    <div class="video-kiosk-top"></div>
                                    <div class="video-kiosk-shell">
                                        <div class="video-kiosk-sensor">
                                            <span class="video-kiosk-lens"></span>
                                        </div>
                                        <div class="video-kiosk-screen">
                                            <video
                                                class="video-kiosk-media"
                                                autoplay
                                                muted
                                                loop
                                                playsinline
                                                preload="metadata"
                                                controlslist="nodownload noplaybackrate"
                                                aria-label="{{ $item['title'] }}"
                                            >
                                                <source src="{{ $item['src'] }}" type="video/mp4">
                                            </video>
                                            <div class="video-kiosk-reflection"></div>
                                        </div>
                                        <div class="video-kiosk-brand">{{ __('common.brand.device') }}</div>
                                    </div>
                                </div>

                                <div class="mt-5 px-2 pb-2">
                                    <p class="text-xs font-semibold uppercase tracking-[0.2em] text-primary">{{ $item['label'] }}</p>
                                    <h3 class="mobile-line-clamp-2 mt-2 text-lg font-semibold text-text">{{ $item['title'] }}</h3>
                                    <p class="mobile-line-clamp-2 mt-2 text-sm leading-7 text-muted">{{ __('home.gallery.item_description') }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <x-device-3d-block />

            <section id="references" class="section-space pt-0">
                <div class="mx-auto grid max-w-7xl gap-10 px-5 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:px-8">
                    <div>
                        <x-section-title
                            :eyebrow="__('home.references.eyebrow')"
                            :title="__('home.references.title')"
                            :description="__('home.references.description')"
                        />

                        <div class="mt-8 space-y-4 sm:mt-10 sm:space-y-5" data-animate-group>
                            @foreach ($testimonials as $testimonial)
                                <article class="panel p-6" data-animate-item>
                                    <p class="text-sm leading-7 text-white/90">"{{ $testimonial['quote'] }}"</p>
                                    <div class="mt-5">
                                        <p class="font-semibold text-text">{{ $testimonial['name'] }}</p>
                                        <p class="text-sm text-muted">{{ $testimonial['role'] }}</p>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>

                    <div class="relative">
                        <div class="stats-shell panel p-6 md:p-8" data-animate-group>
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-primary" data-animate-item>{{ __('common.references.results_eyebrow') }}</p>
                            <div class="mt-6 space-y-5">
                                @foreach ($stats as $stat)
                                    <div class="stat-card rounded-3xl border border-white/10 bg-surface-2 p-5" data-animate-item>
                                        @php
                                            $valueColor = match ($stat['suffix']) {
                                                'x' => 'text-promo',
                                                '/7' => 'text-secondary',
                                                default => 'text-primary',
                                            };
                                        @endphp
                                        <p class="font-display text-4xl font-extrabold tracking-tight text-text">
                                            <span class="{{ $valueColor }}">{{ $stat['prefix'] }}</span><span data-stat-value data-target="{{ $stat['value'] }}" class="{{ $valueColor }}">{{ $stat['value'] }}</span><span class="{{ $valueColor }}">{{ $stat['suffix'] }}</span>
                                        </p>
                                        <p class="mt-2 text-sm text-muted">{{ $stat['label'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="faq" class="section-space pt-0">
                <div class="mx-auto max-w-4xl px-5 sm:px-6 lg:px-8">
                    <x-section-title
                        :eyebrow="__('common.faq.eyebrow')"
                        :title="__('common.faq.title')"
                        :description="__('common.faq.description')"
                        align="center"
                    />

                    <div class="mt-8 space-y-4 sm:mt-10" data-animate-group>
                        @foreach ($faqs as $index => $item)
                            <x-faq-item :item="$item" :index="$index" />
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="audiences" class="section-space pt-0">
                <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
                    <x-section-title
                        :eyebrow="__('home.audiences.eyebrow')"
                        :title="__('home.audiences.title')"
                        :description="__('home.audiences.description')"
                    />

                    <div class="mt-12 grid gap-5 md:grid-cols-2 xl:grid-cols-3" data-animate-group>
                        @foreach ($audiences as $audience)
                            <article class="feature-card panel p-6 js-tilt" data-animate-item>
                                <div class="feature-icon">
                                    @switch($audience['icon'])
                                        @case('booth')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-6 w-6">
                                                <path d="M4 9h16M6 9V6h12v3M6 9v9M18 9v9M9 13h6M9 18h6" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            @break
                                        @case('flag')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-6 w-6">
                                                <path d="M6 21V4m0 0c3-2 6 2 9 0s6 2 6 2v8s-3-2-6-2-6 2-9 0" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            @break
                                        @case('store')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-6 w-6">
                                                <path d="M4 10l1.5-5h13L20 10M5 10v9h14v-9M9 14h6" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            @break
                                        @case('frame')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-6 w-6">
                                                <path d="M5 5h14v14H5zM9 9h6v6H9z" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            @break
                                        @case('bed')
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-6 w-6">
                                                <path d="M4 18v-7h16v7M7 11V8h4v3M4 15h16" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            @break
                                        @default
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-6 w-6">
                                                <path d="M12 4v16M4 12h16M7.5 7.5h9v9h-9z" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                    @endswitch
                                </div>
                                <h3 class="mt-5 text-lg font-semibold text-text">{{ $audience['title'] }}</h3>
                                <p class="mt-3 text-sm leading-7 text-muted">{{ $audience['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="contact" class="section-space pt-0">
                <div class="mx-auto grid max-w-7xl gap-8 px-5 sm:px-6 lg:grid-cols-[0.9fr_1.1fr] lg:px-8">
                    <div class="panel p-6 md:p-8">
                        <x-section-title
                            :eyebrow="__('common.contact.eyebrow')"
                            :title="__('common.contact.title')"
                            :description="__('common.contact.description')"
                        />
                        <p class="mt-4 text-sm font-medium text-white/72">{{ __('common.contact.response_time') }}</p>

                        <div class="mt-8 space-y-5 text-sm text-muted">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-primary">{{ __('common.contact.info.address') }}</p>
                                <p class="mt-2">{{ __('common.contact.info.address_value') }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-primary">{{ __('common.contact.info.phone') }}</p>
                                <p class="mt-2"><a href="tel:{{ preg_replace('/\s+/', '', __('common.contact.info.phone_value')) }}" class="transition hover:text-text">{{ __('common.contact.info.phone_value') }}</a></p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-primary">{{ __('common.contact.info.email') }}</p>
                                <p class="mt-2"><a href="mailto:{{ __('common.contact.info.email_value') }}" class="transition hover:text-text">{{ __('common.contact.info.email_value') }}</a></p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-primary">{{ __('common.contact.info.hours') }}</p>
                                <p class="mt-2">{{ __('common.contact.info.hours_value') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel p-6 md:p-8">
                        <form method="POST" action="{{ route('contact.store', ['lang' => $activeLocale]) }}" class="space-y-5" data-contact-form>
                            @csrf
                            <div class="grid gap-5 md:grid-cols-2">
                                <div>
                                    <label for="name" class="form-label">{{ __('common.contact.labels.name') }}</label>
                                    <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-input" required>
                                    @error('name')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="company" class="form-label">{{ __('common.contact.labels.company') }}</label>
                                    <input id="company" name="company" type="text" value="{{ old('company') }}" class="form-input">
                                    @error('company')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid gap-5 md:grid-cols-2">
                                <div>
                                    <label for="email" class="form-label">{{ __('common.contact.labels.email') }}</label>
                                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-input" required>
                                    @error('email')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="phone" class="form-label">{{ __('common.contact.labels.phone') }}</label>
                                    <input id="phone" name="phone" type="text" value="{{ old('phone') }}" class="form-input">
                                    @error('phone')
                                        <p class="form-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="hidden" aria-hidden="true">
                                <label for="website">{{ __('common.contact.labels.website') }}</label>
                                <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                            </div>

                            <div>
                                <label for="message" class="form-label">{{ __('common.contact.labels.message') }}</label>
                                <textarea id="message" name="message" rows="5" class="form-input min-h-[140px] resize-y" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <p class="text-sm text-muted">{{ __('common.contact.summary') }}</p>
                                <x-button type="submit">{{ __('common.cta.demo') }}</x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-white/5 py-8">
            <div class="mx-auto flex max-w-7xl flex-col gap-5 px-5 text-sm text-muted sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                <div class="flex flex-wrap items-center gap-4">
                    <a href="#features" data-scroll-to class="transition hover:text-text">{{ __('common.nav.features') }}</a>
                    <a href="#gallery" data-scroll-to class="transition hover:text-text">{{ __('common.nav.gallery') }}</a>
                    <a href="#contact" data-scroll-to class="transition hover:text-text">{{ __('common.nav.contact') }}</a>
                </div>

                <div class="flex items-center gap-3">
                    <a href="#" class="social-link" aria-label="{{ __('common.footer.instagram') }}">
                        <span>IG</span>
                    </a>
                    <a href="#" class="social-link" aria-label="{{ __('common.footer.linkedin') }}">
                        <span>IN</span>
                    </a>
                    <a href="#" class="social-link" aria-label="{{ __('common.footer.x') }}">
                        <span>X</span>
                    </a>
                </div>

                <p>&copy; {{ now()->year }} {{ __('common.brand.name') }}</p>
            </div>
        </footer>
    </div>

    @if (session('status'))
        <x-toast :message="session('status')" />
    @endif
</body>
</html>

import './bootstrap';
import anime from 'animejs/lib/anime.es.js';

document.documentElement.classList.add('js');

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const isMobileViewport = window.matchMedia('(max-width: 768px)').matches;
const header = document.querySelector('header');

const getHeaderOffset = () => (header ? header.offsetHeight + 10 : 90);

const clearAnimatedState = (elements) => {
    elements.forEach((element) => {
        element.style.opacity = '1';
        element.style.transform = '';
        element.style.filter = 'blur(0px)';
    });
};

const initMobileNav = () => {
    const toggle = document.querySelector('[data-menu-toggle]');
    const menu = document.getElementById('mobile-menu');

    if (!toggle || !menu) {
        return;
    }

    const setState = (open) => {
        menu.classList.toggle('hidden', !open);
        menu.classList.toggle('is-open', open);
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        menu.setAttribute('aria-hidden', open ? 'false' : 'true');
        document.body.classList.toggle('menu-open', open);
    };

    toggle.addEventListener('click', () => {
        setState(!menu.classList.contains('is-open'));
    });

    menu.querySelectorAll('[data-scroll-to]').forEach((link) => {
        link.addEventListener('click', () => setState(false));
    });

    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            setState(false);
        }
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            setState(false);
        }
    });

    setState(false);
};

const initSmoothScroll = () => {
    document.querySelectorAll('[data-scroll-to]').forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            const href = trigger.getAttribute('href');

            if (!href || !href.startsWith('#')) {
                return;
            }

            if (href === '#top') {
                event.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: prefersReducedMotion ? 'auto' : 'smooth',
                });
                return;
            }

            const target = document.querySelector(href);

            if (!target) {
                return;
            }

            event.preventDefault();
            const top = window.scrollY + target.getBoundingClientRect().top - getHeaderOffset();

            window.scrollTo({
                top,
                behavior: prefersReducedMotion ? 'auto' : 'smooth',
            });
        });
    });
};

const initInitialScrollPosition = () => {
    if ('scrollRestoration' in window.history) {
        window.history.scrollRestoration = 'manual';
    }

    const resetToTop = () => {
        window.scrollTo({ top: 0, left: 0, behavior: 'auto' });
    };

    window.addEventListener('load', resetToTop, { once: true });
    window.addEventListener('pageshow', resetToTop);
};

const initActiveSections = () => {
    const links = Array.from(document.querySelectorAll('[data-nav-link]'));
    const sections = links
        .map((link) => document.getElementById(link.dataset.navLink))
        .filter(Boolean);

    if (!links.length || !sections.length) {
        return;
    }

    const setActive = (id) => {
        links.forEach((link) => {
            const active = link.dataset.navLink === id;
            link.classList.toggle('is-active', active);

            if (active) {
                link.setAttribute('aria-current', 'true');
            } else {
                link.removeAttribute('aria-current');
            }
        });
    };

    const observer = new IntersectionObserver((entries) => {
        const visibleEntry = entries
            .filter((entry) => entry.isIntersecting)
            .sort((left, right) => right.intersectionRatio - left.intersectionRatio)[0];

        if (visibleEntry?.target?.id) {
            setActive(visibleEntry.target.id);
        }
    }, {
        rootMargin: `-${getHeaderOffset()}px 0px -42% 0px`,
        threshold: [0.2, 0.45, 0.7],
    });

    sections.forEach((section) => observer.observe(section));
    setActive(sections[0].id);
};

const initScrollProgress = () => {
    const progress = document.querySelector('[data-scroll-progress]');

    if (!progress) {
        return;
    }

    let ticking = false;

    const update = () => {
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;
        const ratio = scrollable <= 0 ? 0 : (window.scrollY / scrollable) * 100;
        progress.style.width = `${Math.max(0, Math.min(ratio, 100))}%`;
        ticking = false;
    };

    const requestUpdate = () => {
        if (!ticking) {
            window.requestAnimationFrame(update);
            ticking = true;
        }
    };

    window.addEventListener('scroll', requestUpdate, { passive: true });
    window.addEventListener('resize', requestUpdate);
    requestUpdate();
};

const initHeroGlow = () => {
    const glow = document.querySelector('[data-hero-glow]');
    const hero = document.querySelector('.hero-shell');

    if (!glow || !hero) {
        return;
    }

    if (!prefersReducedMotion) {
        anime({
            targets: glow,
            opacity: [0.42, 0.68],
            scale: [0.98, 1.04],
            duration: isMobileViewport ? 2200 : 2800,
            direction: 'alternate',
            easing: 'easeInOutSine',
            loop: true,
        });
    }

    let frameId = null;

    hero.addEventListener('pointermove', (event) => {
        if (prefersReducedMotion) {
            return;
        }

        const rect = hero.getBoundingClientRect();
        const x = ((event.clientX - rect.left) / rect.width - 0.5) * 10;
        const y = ((event.clientY - rect.top) / rect.height - 0.5) * 10;

        if (frameId) {
            cancelAnimationFrame(frameId);
        }

        frameId = window.requestAnimationFrame(() => {
            glow.style.setProperty('--glow-shift-x', `${x}px`);
            glow.style.setProperty('--glow-shift-y', `${y}px`);
        });
    });

    hero.addEventListener('pointerleave', () => {
        glow.style.setProperty('--glow-shift-x', '0px');
        glow.style.setProperty('--glow-shift-y', '0px');
    });
};

const initHeroAnimation = () => {
    const targets = Array.from(document.querySelectorAll('[data-hero-seq]'));

    if (!targets.length) {
        return;
    }

    if (prefersReducedMotion) {
        clearAnimatedState(targets);
        return;
    }

    anime.timeline({
        easing: 'easeOutExpo',
        duration: isMobileViewport ? 600 : 950,
    }).add({
        targets,
        opacity: [0, 1],
        translateY: [isMobileViewport ? 18 : 26, 0],
        delay: anime.stagger(isMobileViewport ? 80 : 110),
        complete: () => clearAnimatedState(targets),
    });
};

const initRevealGroups = () => {
    const groups = Array.from(document.querySelectorAll('[data-animate-group]'));

    if (!groups.length) {
        return;
    }

    const observer = new IntersectionObserver((entries, currentObserver) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting || entry.target.dataset.animated === 'true') {
                return;
            }

            const items = Array.from(entry.target.querySelectorAll('[data-animate-item]'));
            entry.target.dataset.animated = 'true';

            if (prefersReducedMotion) {
                clearAnimatedState(items);
            } else {
                const stagger = Number(entry.target.dataset.animateStagger || 120);
                const duration = Number(entry.target.dataset.animateDuration || (isMobileViewport ? 600 : 820));
                anime({
                    targets: items,
                    opacity: [0, 1],
                    translateY: [50, 0],
                    rotateX: [15, 0],
                    filter: ['blur(4px)', 'blur(0px)'],
                    delay: anime.stagger(isMobileViewport ? Math.min(stagger, 100) : stagger),
                    duration,
                    easing: 'easeOutExpo',
                    complete: () => clearAnimatedState(items),
                });
            }

            currentObserver.unobserve(entry.target);
        });
    }, {
        threshold: 0.18,
    });

    groups.forEach((group) => observer.observe(group));
};

const initParticles = () => {
    if (prefersReducedMotion || isMobileViewport) {
        return;
    }

    anime({
        targets: '.hero-particle',
        translateY: [{ value: -10, duration: 1800 }, { value: 10, duration: 1800 }],
        translateX: [{ value: 6, duration: 2200 }, { value: -6, duration: 2200 }],
        opacity: [{ value: 0.25, duration: 1500 }, { value: 0.85, duration: 1500 }],
        delay: anime.stagger(120),
        direction: 'alternate',
        easing: 'easeInOutSine',
        loop: true,
    });
};

const initTilt = () => {
    const surfaces = Array.from(document.querySelectorAll('.js-tilt'));

    if (!surfaces.length || prefersReducedMotion || isMobileViewport) {
        return;
    }

    surfaces.forEach((surface) => {
        let frameId = null;

        const updateTilt = (x, y) => {
            if (frameId) {
                cancelAnimationFrame(frameId);
            }

            frameId = window.requestAnimationFrame(() => {
                surface.style.setProperty('--tilt-x', `${y}deg`);
                surface.style.setProperty('--tilt-y', `${x}deg`);
            });
        };

        surface.addEventListener('pointermove', (event) => {
            const rect = surface.getBoundingClientRect();
            const offsetX = (event.clientX - rect.left) / rect.width - 0.5;
            const offsetY = (event.clientY - rect.top) / rect.height - 0.5;
            const configuredIntensity = Number(surface.dataset.tiltIntensity || 0);
            const defaultIntensity = surface.classList.contains('feature-card') ? 6 : 10;
            const intensity = configuredIntensity || defaultIntensity;

            updateTilt(offsetX * intensity, offsetY * -intensity);
        });

        surface.addEventListener('pointerleave', () => updateTilt(0, 0));
    });
};

const initParallax = () => {
    const elements = Array.from(document.querySelectorAll('.js-parallax'));

    if (!elements.length || prefersReducedMotion || isMobileViewport) {
        return;
    }

    let ticking = false;

    const paint = () => {
        elements.forEach((element) => {
            const rect = element.getBoundingClientRect();
            const speed = Number(element.dataset.parallaxSpeed || 18);
            const viewportCenter = window.innerHeight / 2;
            const delta = rect.top + rect.height / 2 - viewportCenter;
            const shift = Math.max(Math.min(delta / speed, 30), -30);

            element.style.setProperty('--parallax-shift', `${shift}px`);
        });

        ticking = false;
    };

    const requestPaint = () => {
        if (!ticking) {
            window.requestAnimationFrame(paint);
            ticking = true;
        }
    };

    window.addEventListener('scroll', requestPaint, { passive: true });
    window.addEventListener('resize', requestPaint);
    requestPaint();
};

const initKioskUiAnimation = () => {
    if (prefersReducedMotion) {
        return;
    }

    const lines = document.querySelectorAll('[data-kiosk-line]');
    const progress = document.querySelector('[data-kiosk-progress]');
    const text = document.querySelector('[data-kiosk-text]');

    if (lines.length) {
        anime({
            targets: lines,
            scaleX: [0.75, 1],
            opacity: [0.4, 1],
            delay: anime.stagger(180),
            duration: 1600,
            direction: 'alternate',
            easing: 'easeInOutSine',
            loop: true,
        });
    }

    if (progress) {
        anime({
            targets: progress,
            scaleX: [0.45, 1],
            duration: 1800,
            direction: 'alternate',
            easing: 'easeInOutQuad',
            loop: true,
        });
    }

    if (text) {
        anime({
            targets: text,
            opacity: [0.8, 1],
            translateX: [-6, 0],
            duration: 1500,
            direction: 'alternate',
            easing: 'easeInOutSine',
            loop: true,
        });
    }
};

const initStrategyDeviceAnimation = () => {
    if (prefersReducedMotion) {
        return;
    }

    const strategyCards = Array.from(document.querySelectorAll('.showcase-card'));

    strategyCards.forEach((card, index) => {
        const lines = card.querySelectorAll('[data-strategy-line]');
        const progress = card.querySelector('[data-strategy-progress]');
        const copy = card.querySelector('[data-strategy-copy]');

        if (lines.length) {
            anime({
                targets: lines,
                scaleX: [0.72, 1],
                opacity: [0.45, 0.95],
                delay: anime.stagger(120, { start: index * 120 }),
                duration: 1500,
                direction: 'alternate',
                easing: 'easeInOutSine',
                loop: true,
            });
        }

        if (progress) {
            anime({
                targets: progress,
                scaleX: [0.4, 1],
                duration: 1700,
                delay: index * 140,
                direction: 'alternate',
                easing: 'easeInOutQuad',
                loop: true,
            });
        }

        if (copy) {
            anime({
                targets: copy,
                opacity: [0.82, 1],
                translateY: [4, 0],
                duration: 1300,
                delay: index * 100,
                direction: 'alternate',
                easing: 'easeInOutSine',
                loop: true,
            });
        }
    });
};

const initStats = () => {
    const stats = Array.from(document.querySelectorAll('[data-stat-value]'));

    if (!stats.length) {
        return;
    }

    const observer = new IntersectionObserver((entries, currentObserver) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting || entry.target.dataset.done === 'true') {
                return;
            }

            const target = Number(entry.target.dataset.target || 0);
            entry.target.dataset.done = 'true';

            if (prefersReducedMotion) {
                entry.target.textContent = String(target);
            } else {
                anime({
                    targets: { value: 0 },
                    value: target,
                    round: 1,
                    duration: 1200,
                    easing: 'easeOutExpo',
                    update: (animation) => {
                        entry.target.textContent = String(animation.animations[0].currentValue);
                    },
                });
            }

            currentObserver.unobserve(entry.target);
        });
    }, {
        threshold: 0.5,
    });

    stats.forEach((stat) => observer.observe(stat));
};

const initAccordion = () => {
    const triggers = Array.from(document.querySelectorAll('[data-faq-trigger]'));

    if (!triggers.length) {
        return;
    }

    const togglePanel = (trigger) => {
        const panel = document.getElementById(trigger.getAttribute('aria-controls'));

        if (!panel) {
            return;
        }

        const expanded = trigger.getAttribute('aria-expanded') === 'true';
        trigger.setAttribute('aria-expanded', expanded ? 'false' : 'true');

        if (expanded) {
            panel.style.maxHeight = `${panel.scrollHeight}px`;
            window.requestAnimationFrame(() => {
                panel.style.maxHeight = '0px';
            });
            window.setTimeout(() => {
                panel.hidden = true;
            }, prefersReducedMotion ? 0 : 260);
        } else {
            panel.hidden = false;
            panel.style.maxHeight = '0px';
            window.requestAnimationFrame(() => {
                panel.style.maxHeight = `${panel.scrollHeight}px`;
            });
        }
    };

    triggers.forEach((trigger, index) => {
        trigger.addEventListener('click', () => togglePanel(trigger));

        trigger.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowDown') {
                event.preventDefault();
                triggers[(index + 1) % triggers.length].focus();
            }

            if (event.key === 'ArrowUp') {
                event.preventDefault();
                triggers[(index - 1 + triggers.length) % triggers.length].focus();
            }
        });
    });
};

const initToast = () => {
    const toast = document.querySelector('[data-toast]');

    if (!toast) {
        return;
    }

    if (prefersReducedMotion) {
        toast.style.opacity = '1';
        toast.style.transform = 'none';
    } else {
        anime({
            targets: toast,
            opacity: [0, 1],
            translateY: [16, 0],
            easing: 'easeOutCubic',
            duration: 380,
        });
    }

    window.setTimeout(() => {
        if (prefersReducedMotion) {
            toast.remove();
            return;
        }

        anime({
            targets: toast,
            opacity: [1, 0],
            translateY: [0, 10],
            easing: 'easeInCubic',
            duration: 260,
            complete: () => toast.remove(),
        });
    }, 4200);
};

initMobileNav();
initInitialScrollPosition();
initSmoothScroll();
initActiveSections();
initScrollProgress();
initHeroGlow();
initHeroAnimation();
initRevealGroups();
initParticles();
initTilt();
initParallax();
initKioskUiAnimation();
initStrategyDeviceAnimation();
initStats();
initAccordion();
initToast();

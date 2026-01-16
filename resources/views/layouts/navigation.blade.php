<nav
    x-data="{ open: false, solid: false }"
    x-init="solid = window.scrollY > 40; window.addEventListener('scroll', () => solid = window.scrollY > 40)"
    :class="solid ? 'bg-white/95 shadow-lg shadow-black/5' : 'bg-white/80'"
    class="fixed inset-x-0 top-0 z-50 transition-colors duration-300 backdrop-blur"
>
    <div class="mx-auto flex max-w-7xl items-center justify-between lg:justify-center px-6" style="height: 60px; overflow: visible;">
        <a href="{{ url('/') }}" class="flex items-center lg:hidden" style="overflow: visible;">
            <x-animated-navbar-text />
        </a>

        <div class="hidden items-center gap-12 lg:flex">
            @foreach ([
                ['label' => 'Home', 'href' => '#home'],
                ['label' => 'Products', 'href' => '#products'],
                ['label' => 'Services', 'href' => '#services'],
                ['label' => 'About Us', 'href' => '#about'],
                ['label' => 'Manufacturing', 'href' => '#manufacturing'],
                ['label' => 'FAQ', 'href' => '#faq'],
            ] as $item)
                <a
                    href="{{ $item['href'] }}"
                    class="text-sm font-medium uppercase tracking-[0.2em] text-maklos-700/80 transition hover:text-maklos-600"
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>

        <button
            @click="open = ! open"
            class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-maklos-200 text-maklos-700 lg:hidden"
            aria-label="Toggle navigation"
        >
            <svg x-show="! open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div x-show="open" x-transition class="lg:hidden">
        <div class="space-y-3 bg-white/95 px-6 pb-6 pt-2 backdrop-blur">
            @foreach (['home', 'products', 'services', 'about', 'manufacturing', 'faq'] as $section)
                <a
                    href="#{{ $section }}"
                    class="block rounded-lg px-4 py-3 text-base font-semibold text-maklos-700/85 transition hover:bg-maklos-50"
                    @click="open = false"
                >
                    {{ \Illuminate\Support\Str::title(str_replace('-', ' ', $section)) }}
                </a>
            @endforeach

            <!-- Contact buttons (WhatsApp, Email, Call) removed from mobile menu as requested -->
        </div>
    </div>
</nav>


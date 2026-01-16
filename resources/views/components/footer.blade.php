<footer class="bg-maklos-900 py-4 lg:py-12 text-center text-sm text-white/75">
    <div class="container mx-auto px-4">
        <!-- Animated MAKLOS TRADER Text -->
        <div class="mb-3 lg:mb-8 flex items-center justify-center min-h-[80px] lg:min-h-[180px]">
            <x-animated-footer-text class="max-w-4xl mx-auto" />
        </div>

        <!-- Copyright -->
        <div class="border-t border-white/20 pt-3 lg:pt-6">
            © {{ now()->year }} {{ $siteSettings['company_name'] ?? 'Maklos Trader' }}. All rights reserved.
        </div>
    </div>
</footer>
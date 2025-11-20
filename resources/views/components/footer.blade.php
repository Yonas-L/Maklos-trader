<footer class="bg-maklos-900 py-8 lg:py-12 text-center text-sm text-white/75">
    <div class="container mx-auto px-4">
        <!-- Animated MAKLOS TRADER Text -->
        <div class="mb-6 lg:mb-8 flex items-center justify-center" style="min-height: 180px;">
            <x-animated-footer-text class="max-w-4xl mx-auto" />
        </div>

        <!-- Copyright -->
        <div class="border-t border-white/20 pt-6">
            © {{ now()->year }} {{ $siteSettings['company_name'] ?? 'Maklos Trader' }}. All rights reserved.
        </div>
    </div>
</footer>
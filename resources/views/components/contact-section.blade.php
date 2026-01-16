@props(['settings'])

<!-- Contact Section with Gradient Background -->
<section id="contact" class="relative py-8 lg:py-20 overflow-hidden bg-white">
    <!-- Gradient Shadow Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-teal-50 to-cyan-50 opacity-60"></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-8 lg:mb-16 contact-header">
            <div class="js-contact-header mb-2 flex items-center justify-center h-12 lg:h-24">
                <h2
                    class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-center transform translate-y-1 lg:translate-y-2">
                    <span class="text-black">Get In</span>
                    <span class="ml-3" style="color: #0d9488;">Touch</span>
                </h2>
            </div>
            <p class="text-maklos-600 text-base font-semibold">
                Work with Us - Let's Build Something Great Together
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-start">
            <!-- Contact Form -->
            <div class="contact-form order-2 lg:order-1">
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-xl">
                    <form id="contactForm" class="space-y-6">
                        @csrf

                        <!-- Name Input -->
                        <div class="form-group">
                            <label for="name" class="block text-charcoal font-medium mb-2">Your Name *</label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-charcoal placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-maklos-500 focus:border-transparent transition-all duration-300"
                                placeholder="John Doe">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <!-- Email Input -->
                        <div class="form-group">
                            <label for="email" class="block text-charcoal font-medium mb-2">Your Email *</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-charcoal placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-maklos-500 focus:border-transparent transition-all duration-300"
                                placeholder="john@example.com">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <!-- Phone Input -->
                        <div class="form-group">
                            <label for="phone" class="block text-charcoal font-medium mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-charcoal placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-maklos-500 focus:border-transparent transition-all duration-300"
                                placeholder="+123 456 7890">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <!-- Subject Input -->
                        <div class="form-group">
                            <label for="subject" class="block text-charcoal font-medium mb-2">Subject *</label>
                            <input type="text" id="subject" name="subject" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-charcoal placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-maklos-500 focus:border-transparent transition-all duration-300"
                                placeholder="Product Inquiry">
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <!-- Message Textarea -->
                        <div class="form-group">
                            <label for="message" class="block text-charcoal font-medium mb-2">Your Message *</label>
                            <textarea id="message" name="message" rows="5" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg text-charcoal placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-maklos-500 focus:border-transparent transition-all duration-300 resize-none"
                                placeholder="Tell us about your inquiry..."></textarea>
                            <span class="error-message text-red-500 text-sm mt-1 hidden"></span>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="submitBtn"
                            class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span class="submit-text">Send Message</span>
                            <span class="loading-text hidden">
                                <svg class="animate-spin inline-block w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Sending...
                            </span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Information Cards -->
            <div class="space-y-4 lg:space-y-6 contact-info order-1 lg:order-2">
                <!-- Email Card -->
                <div
                    class="contact-card bg-white rounded-xl p-6 border border-gray-200 hover:border-maklos-500 transition-all duration-300 hover:shadow-lg shadow-md transform hover:-translate-y-1">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-lg flex items-center justify-center shadow-lg shadow-teal-500/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-charcoal font-semibold text-xl mb-1">Email Us</h3>
                            <a href="mailto:{{ $settings->email ?? 'info@maklostrading.com' }}"
                                class="text-maklos-600 hover:text-maklos-700 transition-colors text-lg">
                                {{ $settings->email ?? 'info@maklostrading.com' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Phone Card -->
                <div
                    class="contact-card bg-white rounded-xl p-6 border border-gray-200 hover:border-maklos-500 transition-all duration-300 hover:shadow-lg shadow-md transform hover:-translate-y-1">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-charcoal font-semibold text-xl mb-1">Call Us</h3>
                            @php
                                $phoneRaw = $settings->phone ?? '';
                                $phones = json_decode($phoneRaw, true);
                                if (json_last_error() !== JSON_ERROR_NONE || !is_array($phones)) {
                                    $phones = $phoneRaw ? [$phoneRaw] : ['+251 91 126 6949'];
                                }
                            @endphp

                            @foreach($phones as $phone)
                                <a href="tel:{{ $phone }}"
                                    class="block text-maklos-600 hover:text-maklos-700 transition-colors text-lg">
                                    {{ $phone }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Address Card -->
                <div
                    class="contact-card bg-white rounded-xl p-6 border border-gray-200 hover:border-maklos-500 transition-all duration-300 hover:shadow-lg shadow-md transform hover:-translate-y-1">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg shadow-cyan-500/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-charcoal font-semibold text-xl mb-1">Visit Us</h3>
                            <p class="text-maklos-600 text-lg">
                                {{ $settings->address ?? 'Maklos Trading, Africa' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Modal -->
    <div id="notificationModal"
        class="hidden fixed inset-0 z-[100] flex items-center justify-center px-4 opacity-0 transition-opacity duration-300">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" style="clip-path: none;"
            onclick="closeModal()"></div>

        <!-- Modal Card -->
        <div
            class="relative bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-full text-center transform scale-95 transition-all duration-300">
            <!-- Icon Wrapper -->
            <div id="modalIconBg"
                class="mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4 transition-colors">
                <i id="modalIcon" class="text-2xl"></i>
            </div>

            <h3 id="modalTitle" class="text-xl font-bold text-slate-900 mb-2"></h3>
            <p id="modalMessage" class="text-slate-600 mb-6"></p>

            <button onclick="closeModal()" id="modalBtn"
                class="w-full py-3 px-4 rounded-xl font-semibold text-white transition-all transform active:scale-95 hover:shadow-lg">
                Close
            </button>
        </div>
    </div>
</section>

<!-- Contact Form JavaScript -->
<script>
    const modal = document.getElementById('notificationModal');
    const modalIconBg = document.getElementById('modalIconBg');
    const modalIcon = document.getElementById('modalIcon');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const modalBtn = document.getElementById('modalBtn');
    let autoCloseTimer;

    function showModal(type, title, message) {
        // Stop any pending auto-close
        clearTimeout(autoCloseTimer);

        // Styling based on type
        if (type === 'success') {
            modalIconBg.className = 'mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4 bg-green-100 text-green-600';
            modalIcon.className = 'fa-solid fa-check text-2xl';
            modalBtn.className = 'w-full py-3 px-4 rounded-xl font-semibold text-white bg-green-600 hover:bg-green-700 shadow-green-200';

            // Auto close for success
            autoCloseTimer = setTimeout(closeModal, 5000);
        } else {
            modalIconBg.className = 'mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4 bg-red-100 text-red-600';
            modalIcon.className = 'fa-solid fa-xmark text-2xl';
            modalBtn.className = 'w-full py-3 px-4 rounded-xl font-semibold text-white bg-red-600 hover:bg-red-700 shadow-red-200';
        }

        modalTitle.textContent = title;
        modalMessage.textContent = message;

        // Show (Fade In) - Remove hidden first, then animate
        modal.classList.remove('hidden');
        // Force reflow to enable transition
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        modal.querySelector('.transform').classList.remove('scale-95');
        modal.querySelector('.transform').classList.add('scale-100');
    }

    function closeModal() {
        modal.classList.add('opacity-0');
        modal.querySelector('.transform').classList.remove('scale-100');
        modal.querySelector('.transform').classList.add('scale-95');
        // Add hidden after transition completes
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('contactForm');
        const submitBtn = document.getElementById('submitBtn');

        // Form submission handler
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            // Clear previous field errors
            document.querySelectorAll('.error-message').forEach(el => {
                el.classList.add('hidden');
                el.textContent = '';
            });

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.querySelector('.submit-text').classList.add('hidden');
            submitBtn.querySelector('.loading-text').classList.remove('hidden');

            // Get form data
            const formData = new FormData(form);

            try {
                const response = await fetch('{{ route('contact.submit') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': formData.get('_token'),
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showModal('success', 'Email Sent Successfully!', 'Your email has been sent successfully. We will get back to you shortly.');
                    form.reset();
                } else {
                    // Show error messages
                    if (data.errors) {
                        // Display field-specific errors
                        Object.keys(data.errors).forEach(key => {
                            const input = document.getElementById(key);
                            if (input) {
                                const errorSpan = input.parentElement.querySelector('.error-message');
                                if (errorSpan) {
                                    errorSpan.textContent = data.errors[key][0];
                                    errorSpan.classList.remove('hidden');
                                }
                            }
                        });

                        // Also show modal for clarity
                        showModal('error', 'Submission Failed', 'Please fix the errors highlighted in the form.');
                    } else {
                        // Show general error message
                        showModal('error', 'Email Not Sent', data.message || 'Email not sent. Try again please.');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                showModal('error', 'Connection Error', 'Network error. Please check your connection and try again.');
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                submitBtn.querySelector('.submit-text').classList.remove('hidden');
                submitBtn.querySelector('.loading-text').classList.add('hidden');
            }
        });
    });
</script>

<style>
    /* Blob Animation */
    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }

        33% {
            transform: translate(30px, -50px) scale(1.1);
        }

        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }

        100% {
            transform: translate(0px, 0px) scale(1);
        }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }

    /* Input focus effects */
    input:focus,
    textarea:focus {
        transform: translateY(-2px);
    }

    /* Smooth transitions for all interactive elements */
    .contact-card,
    .contact-map,
    button,
    input,
    textarea {
        transition: all 0.3s ease;
    }
</style>
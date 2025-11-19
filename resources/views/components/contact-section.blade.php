@props(['settings'])

<!-- Contact Section with Gradient Background -->
<section id="contact" class="relative py-20 overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 opacity-15">
        <div class="absolute top-0 -left-4 w-72 h-72 bg-teal-500 rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
        <div class="absolute top-0 -right-4 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Section Header -->
        <div class="text-center mb-16 contact-header">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Get In <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-300 to-blue-400">Touch</span>
            </h2>
            <p class="text-gray-200 text-lg max-w-2xl mx-auto">
                Have questions about our products? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <!-- Contact Information & Map -->
            <div class="space-y-8 contact-info">
                <!-- Contact Cards -->
                <div class="space-y-6">
                    <!-- Email Card -->
                    <div class="contact-card bg-white/5 backdrop-blur-lg rounded-xl p-6 border border-white/10 hover:border-teal-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-teal-500/10 transform hover:-translate-y-1">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-lg flex items-center justify-center shadow-lg shadow-teal-500/20">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg mb-1">Email Us</h3>
                                <a href="mailto:{{ $settings->email ?? 'info@maklostrading.com' }}" class="text-teal-300 hover:text-teal-200 transition-colors">
                                    {{ $settings->email ?? 'info@maklostrading.com' }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Phone Card -->
                    <div class="contact-card bg-white/5 backdrop-blur-lg rounded-xl p-6 border border-white/10 hover:border-blue-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/10 transform hover:-translate-y-1">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/20">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg mb-1">Call Us</h3>
                                <a href="tel:{{ $settings->phone ?? '+1234567890' }}" class="text-blue-300 hover:text-blue-200 transition-colors">
                                    {{ $settings->phone ?? '+123 456 7890' }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Address Card -->
                    <div class="contact-card bg-white/5 backdrop-blur-lg rounded-xl p-6 border border-white/10 hover:border-cyan-500/50 transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/10 transform hover:-translate-y-1">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-lg flex items-center justify-center shadow-lg shadow-cyan-500/20">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold text-lg mb-1">Visit Us</h3>
                                <p class="text-cyan-300">
                                    {{ $settings->address ?? 'Maklos Trading, Africa' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="contact-map bg-white/5 backdrop-blur-lg rounded-xl p-2 border border-white/10 overflow-hidden">
                    <div class="rounded-lg overflow-hidden h-80">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.8701537267956!2d-0.1870493!3d5.6037168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNcKwMzYnMTMuNCJOIDDCsDExJzEzLjQiVw!5e0!3m2!1sen!2s!4v1234567890123"
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            class="grayscale-[70%] hover:grayscale-0 transition-all duration-500">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form">
                <div class="bg-white/5 backdrop-blur-lg rounded-xl p-8 border border-white/10 shadow-xl">
                    <form id="contactForm" class="space-y-6">
                        @csrf
                        
                        <!-- Success Message -->
                        <div id="successMessage" class="hidden bg-green-500/20 border border-green-500 text-green-200 px-4 py-3 rounded-lg mb-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span id="successText"></span>
                            </div>
                        </div>

                        <!-- Error Message -->
                        <div id="errorMessage" class="hidden bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded-lg mb-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span id="errorText"></span>
                            </div>
                        </div>

                        <!-- Name Input -->
                        <div class="form-group">
                            <label for="name" class="block text-white font-medium mb-2">Your Name *</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                required
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300"
                                placeholder="John Doe"
                            >
                            <span class="error-message text-red-400 text-sm mt-1 hidden"></span>
                        </div>

                        <!-- Email Input -->
                        <div class="form-group">
                            <label for="email" class="block text-white font-medium mb-2">Your Email *</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                required
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300"
                                placeholder="john@example.com"
                            >
                            <span class="error-message text-red-400 text-sm mt-1 hidden"></span>
                        </div>

                        <!-- Phone Input -->
                        <div class="form-group">
                            <label for="phone" class="block text-white font-medium mb-2">Phone Number</label>
                            <input 
                                type="tel" 
                                id="phone" 
                                name="phone"
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300"
                                placeholder="+123 456 7890"
                            >
                            <span class="error-message text-red-400 text-sm mt-1 hidden"></span>
                        </div>

                        <!-- Subject Input -->
                        <div class="form-group">
                            <label for="subject" class="block text-white font-medium mb-2">Subject *</label>
                            <input 
                                type="text" 
                                id="subject" 
                                name="subject" 
                                required
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300"
                                placeholder="Product Inquiry"
                            >
                            <span class="error-message text-red-400 text-sm mt-1 hidden"></span>
                        </div>

                        <!-- Message Textarea -->
                        <div class="form-group">
                            <label for="message" class="block text-white font-medium mb-2">Your Message *</label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="5" 
                                required
                                class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300 resize-none"
                                placeholder="Tell us about your inquiry..."
                            ></textarea>
                            <span class="error-message text-red-400 text-sm mt-1 hidden"></span>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            id="submitBtn"
                            class="w-full bg-gradient-to-r from-teal-600 to-blue-600 hover:from-teal-700 hover:to-blue-700 text-white font-semibold py-4 px-6 rounded-lg transition-all duration-300 transform hover:scale-[1.01] hover:shadow-xl hover:shadow-teal-500/30 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:ring-offset-slate-900"
                        >
                            <span class="submit-text">Send Message</span>
                            <span class="loading-text hidden">
                                <svg class="animate-spin inline-block w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Sending...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    const successText = document.getElementById('successText');
    const errorText = document.getElementById('errorText');

    // GSAP Animations for Contact Section
    if (typeof gsap !== 'undefined') {
        // Animate header on scroll
        gsap.from('.contact-header', {
            scrollTrigger: {
                trigger: '.contact-header',
                start: 'top 80%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            y: 50,
            duration: 1,
            ease: 'power3.out'
        });

        // Animate contact info cards
        gsap.from('.contact-card', {
            scrollTrigger: {
                trigger: '.contact-info',
                start: 'top 80%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            x: -50,
            duration: 0.8,
            stagger: 0.2,
            ease: 'power3.out'
        });

        // Animate map
        gsap.from('.contact-map', {
            scrollTrigger: {
                trigger: '.contact-map',
                start: 'top 80%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            scale: 0.9,
            duration: 1,
            ease: 'power3.out'
        });

        // Animate form
        gsap.from('.contact-form', {
            scrollTrigger: {
                trigger: '.contact-form',
                start: 'top 80%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            x: 50,
            duration: 1,
            ease: 'power3.out'
        });

        // Animate form groups
        gsap.from('.form-group', {
            scrollTrigger: {
                trigger: '.contact-form',
                start: 'top 70%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            y: 30,
            duration: 0.6,
            stagger: 0.1,
            ease: 'power2.out'
        });
    }

    // Form submission handler
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Clear previous messages
        successMessage.classList.add('hidden');
        errorMessage.classList.add('hidden');
        
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
                // Show success message
                successText.textContent = data.message;
                successMessage.classList.remove('hidden');
                
                // Animate success message
                if (typeof gsap !== 'undefined') {
                    gsap.from('#successMessage', {
                        opacity: 0,
                        y: -20,
                        duration: 0.5,
                        ease: 'power2.out'
                    });
                }
                
                // Reset form
                form.reset();
                
                // Hide success message after 5 seconds
                setTimeout(() => {
                    successMessage.classList.add('hidden');
                }, 5000);
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
                } else {
                    // Show general error message
                    errorText.textContent = data.message || 'Something went wrong. Please try again.';
                    errorMessage.classList.remove('hidden');
                    
                    if (typeof gsap !== 'undefined') {
                        gsap.from('#errorMessage', {
                            opacity: 0,
                            y: -20,
                            duration: 0.5,
                            ease: 'power2.out'
                        });
                    }
                }
            }
        } catch (error) {
            console.error('Error:', error);
            errorText.textContent = 'Network error. Please check your connection and try again.';
            errorMessage.classList.remove('hidden');
            
            if (typeof gsap !== 'undefined') {
                gsap.from('#errorMessage', {
                    opacity: 0,
                    y: -20,
                    duration: 0.5,
                    ease: 'power2.out'
                });
            }
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
input:focus, textarea:focus {
    transform: translateY(-2px);
}

/* Smooth transitions for all interactive elements */
.contact-card, .contact-map, button, input, textarea {
    transition: all 0.3s ease;
}
</style>

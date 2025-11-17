<div class="animated-navbar-text">
  <svg viewBox="0 0 240 40" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Maklos Trader">
    <defs>
      <linearGradient id="navbarTextGradient" x1="0%" y1="0%" x2="100%" y2="0%">
        <stop offset="0%" style="stop-color:#1a4899;stop-opacity:1" />
        <stop offset="50%" style="stop-color:#2f74e6;stop-opacity:1" />
        <stop offset="100%" style="stop-color:#1a4899;stop-opacity:1" />
      </linearGradient>
    </defs>

    <!-- Letters positioned for navbar with increased spacing -->
    <g class="navbar-text-group" transform="translate(3, 5)">
      <!-- M -->
      <path class="navbar-text-stroke"
        d="M5 25 L5 5 L10 15 L15 5 L15 25"
        stroke="url(#navbarTextGradient)" stroke-width="3" fill="none"
        stroke-linecap="round" stroke-linejoin="round" />

      <!-- A -->
      <path class="navbar-text-stroke"
        d="M28 25 L33 5 L38 25 M29 20 L37 20"
        stroke="url(#navbarTextGradient)" stroke-width="3" fill="none"
        stroke-linecap="round" stroke-linejoin="round" />

      <!-- K -->
      <path class="navbar-text-stroke"
        d="M45 5 L45 25 M45 15 L50 5 M45 15 L50 25"
        stroke="url(#navbarTextGradient)" stroke-width="3" fill="none"
        stroke-linecap="round" stroke-linejoin="round" />

      <!-- L -->
      <path class="navbar-text-stroke"
        d="M57 5 L57 25 L65 25"
        stroke="url(#navbarTextGradient)" stroke-width="3" fill="none"
        stroke-linecap="round" stroke-linejoin="round" />

      <!-- O -->
      <path class="navbar-text-stroke"
        d="M72 15
           Q72 5 79 5
           Q86 5 86 15
           Q86 25 79 25
           Q72 25 72 15 Z"
        stroke="url(#navbarTextGradient)" stroke-width="3" fill="none"
        stroke-linecap="round" stroke-linejoin="round" />

      <!-- S -->
      <path class="navbar-text-stroke"
        d="M104 8
           Q104 5 100 5
           Q95 5 95 10
           Q95 15 100 15
           Q104 15 104 20
           Q104 25 100 25
           Q95 25 95 22"
        stroke="url(#navbarTextGradient)" stroke-width="3" fill="none"
        stroke-linecap="round" stroke-linejoin="round" />

      <!-- Word Gap - proper space between MAKLOS and TRADER -->
      
      <!-- T -->
      <path class="navbar-text-stroke"
        d="M122 5 L132 5 M127 5 L127 25"
        stroke="url(#navbarTextGradient)" stroke-width="3" fill="none"
        stroke-linecap="round" stroke-linejoin="round" />

      <!-- R -->
      <path class="navbar-text-stroke"
        d="M139 25 L139 5 L146 5
           Q151 5 151 10
           Q151 14 146 14
           L139 14
           L151 25"
        stroke="url(#navbarTextGradient)" stroke-width="3" fill="none"
        stroke-linecap="round" stroke-linejoin="round" />

      <!-- A -->
      <path class="navbar-text-stroke"
        d="M158 25 L163 5 L168 25 M159 20 L167 20"
        stroke="url(#navbarTextGradient)" stroke-width="3" fill="none"
        stroke-linecap="round" stroke-linejoin="round" />

      <!-- D -->
      <path class="navbar-text-stroke"
        d="M175 5 L175 25
           Q181 25 183 25
           Q187 25 187 15
           Q187 5 183 5
           Q175 5 175 5"
        stroke="url(#navbarTextGradient)" stroke-width="3" fill="none"
        stroke-linecap="round" stroke-linejoin="round" />

      <!-- E -->
      <path class="navbar-text-stroke"
        d="M194 5 L194 25
           M194 5 L202 5
           M194 15 L201 15
           M194 25 L202 25"
        stroke="url(#navbarTextGradient)" stroke-width="3" fill="none"
        stroke-linecap="round" stroke-linejoin="round" />

      <!-- R -->
      <path class="navbar-text-stroke"
        d="M209 25 L209 5 L216 5
           Q221 5 221 10
           Q221 14 216 14
           L209 14
           L221 25"
        stroke="url(#navbarTextGradient)" stroke-width="3" fill="none"
        stroke-linecap="round" stroke-linejoin="round" />
    </g>
  </svg>
</div>

<style>
  .animated-navbar-text {
    display: inline-block;
    width: 240px;
    height: 40px;
  }

  .animated-navbar-text svg {
    width: 100%;
    height: auto;
  }

  .navbar-text-stroke {
    filter: drop-shadow(0 0 3px rgba(26, 72, 153, 0.3));
  }
</style>

<script>
  function initNavbarAnimation() {
    // Get all navbar text stroke paths
    const navbarTextStrokes = document.querySelectorAll('.navbar-text-stroke');
    
    // Set initial state
    gsap.set(navbarTextStrokes, {
      strokeDasharray: '500',
      strokeDashoffset: '500',
      opacity: 0
    });
    
    // Create animation timeline
    const tl = gsap.timeline({
      paused: true,
      delay: 0.5 // Small delay for dramatic effect
    });
    
    // Animate navbar text drawing
    tl.to(navbarTextStrokes, {
      strokeDashoffset: 0,
      opacity: 1,
      duration: 1.5,
      stagger: 0.05,
      ease: "power2.inOut"
    });
    
    // Play animation when page loads
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => tl.play(), 500);
      });
    } else {
      setTimeout(() => tl.play(), 500);
    }
  }
  
  // Initialize animation
  initNavbarAnimation();
</script>

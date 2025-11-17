<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>MAKLOS TRADER — SVG Stroke Animation</title>
<style>
  .animated-footer-text {
    position: relative;
    width: 100%;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  .animated-footer-text svg {
    max-width: 100%;
    height: auto;
    position: relative;
    z-index: 10;
  }

  /* Soap Bubbles Container */
  .soap-bubbles-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
  }

  .bubble {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.8), rgba(251, 191, 36, 0.4), rgba(255, 255, 255, 0.1));
    box-shadow: 
      0 0 10px rgba(255, 255, 255, 0.3),
      inset -5px -5px 10px rgba(255, 255, 255, 0.3),
      inset 5px 5px 10px rgba(251, 191, 36, 0.2);
    opacity: 0;
    transform: scale(0) translateY(100px);
  }

  .bubble::before {
    content: '';
    position: absolute;
    top: 10%;
    left: 20%;
    width: 30%;
    height: 30%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.9), transparent);
    border-radius: 50%;
    filter: blur(2px);
  }

  /* Individual bubble positions and sizes */
  .bubble-1 {
    width: 40px;
    height: 40px;
    left: 10%;
    bottom: -50px;
  }

  .bubble-2 {
    width: 25px;
    height: 25px;
    left: 25%;
    bottom: -50px;
  }

  .bubble-3 {
    width: 35px;
    height: 35px;
    left: 40%;
    bottom: -50px;
  }

  .bubble-4 {
    width: 20px;
    height: 20px;
    left: 55%;
    bottom: -50px;
  }

  .bubble-5 {
    width: 45px;
    height: 45px;
    left: 70%;
    bottom: -50px;
  }

  .bubble-6 {
    width: 30px;
    height: 30px;
    left: 85%;
    bottom: -50px;
  }

  .bubble-7 {
    width: 22px;
    height: 22px;
    left: 15%;
    bottom: -50px;
  }

  .bubble-8 {
    width: 38px;
    height: 38px;
    left: 80%;
    bottom: -50px;
  }

  /* Bubble animation classes */
  .bubble-float {
    animation: floatUp 8s ease-in-out infinite;
  }

  @keyframes floatUp {
    0% {
      transform: scale(0) translateY(100px);
      opacity: 0;
    }
    10% {
      transform: scale(1) translateY(80px);
      opacity: 0.7;
    }
    50% {
      transform: scale(1.1) translateY(-20px);
      opacity: 0.8;
    }
    90% {
      transform: scale(0.9) translateY(-120px);
      opacity: 0.3;
    }
    100% {
      transform: scale(0.8) translateY(-150px);
      opacity: 0;
    }
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .animated-footer-text svg {
      max-width: 100%;
      height: auto;
    }
    
    .bubble {
      transform: scale(0.8);
    }
  }

  .text-stroke {
    filter: drop-shadow(0 0 10px rgba(251, 191, 36, 0.5));
  }
  @media (min-width: 768px) {
    .animated-footer-text svg {
      max-width: 100%;
      height: auto;
    }
  }
</style>
</head>
<body>
  <!-- If using Blade: @props(['class' => '']); then add class="{{ $class }}" on the div -->
  <div class="animated-footer-text">
    <!-- Soap Bubbles Container -->
    <div class="soap-bubbles-container">
      <div class="bubble bubble-1"></div>
      <div class="bubble bubble-2"></div>
      <div class="bubble bubble-3"></div>
      <div class="bubble bubble-4"></div>
      <div class="bubble bubble-5"></div>
      <div class="bubble bubble-6"></div>
      <div class="bubble bubble-7"></div>
      <div class="bubble bubble-8"></div>
    </div>
    
    <svg viewBox="0 0 1000 200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="MAKLOS TRADER">
      <defs>
        <linearGradient id="textGradient" x1="0%" y1="0%" x2="100%" y2="0%">
          <stop offset="0%" style="stop-color:#ffffff;stop-opacity:1" />
          <stop offset="50%" style="stop-color:#fbbf24;stop-opacity:1" />
          <stop offset="100%" style="stop-color:#ffffff;stop-opacity:1" />
        </linearGradient>
        <!-- Bubble gradients -->
        <radialGradient id="bubbleGradient1">
          <stop offset="0%" style="stop-color:#ffffff;stop-opacity:0.8" />
          <stop offset="50%" style="stop-color:#fbbf24;stop-opacity:0.4" />
          <stop offset="100%" style="stop-color:#ffffff;stop-opacity:0.1" />
        </radialGradient>
        <radialGradient id="bubbleGradient2">
          <stop offset="0%" style="stop-color:#fef3c7;stop-opacity:0.9" />
          <stop offset="60%" style="stop-color:#fbbf24;stop-opacity:0.3" />
          <stop offset="100%" style="stop-color:#ffffff;stop-opacity:0.1" />
        </radialGradient>
      </defs>

      <!-- Letters positioned with better spacing and word separation -->
      <g class="animated-text-group" transform="translate(80, 60)">
        <!-- M -->
        <path class="text-stroke"
          d="M50 80 L50 20 L70 50 L90 20 L90 80"
          stroke="url(#textGradient)" stroke-width="8" fill="none"
          stroke-linecap="round" stroke-linejoin="round" />

        <!-- A -->
        <path class="text-stroke"
          d="M120 80 L140 20 L160 80 M125 65 L155 65"
          stroke="url(#textGradient)" stroke-width="8" fill="none"
          stroke-linecap="round" stroke-linejoin="round" />

        <!-- K -->
        <path class="text-stroke"
          d="M185 20 L185 80 M185 50 L205 20 M185 50 L205 80"
          stroke="url(#textGradient)" stroke-width="8" fill="none"
          stroke-linecap="round" stroke-linejoin="round" />

        <!-- L -->
        <path class="text-stroke"
          d="M230 20 L230 80 L265 80"
          stroke="url(#textGradient)" stroke-width="8" fill="none"
          stroke-linecap="round" stroke-linejoin="round" />

        <!-- O -->
        <path class="text-stroke"
          d="M295 50
             Q295 20 325 20
             Q355 20 355 50
             Q355 80 325 80
             Q295 80 295 50 Z"
          stroke="url(#textGradient)" stroke-width="8" fill="none"
          stroke-linecap="round" stroke-linejoin="round" />

        <!-- S (fixed with better curves) -->
        <path class="text-stroke"
          d="M415 30
             Q415 20 400 20
             Q380 20 380 35
             Q380 50 400 50
             Q415 50 415 65
             Q415 80 400 80
             Q380 80 380 70"
          stroke="url(#textGradient)" stroke-width="8" fill="none"
          stroke-linecap="round" stroke-linejoin="round" />

        <!-- Word Gap - increased space between MAKLOS and TRADER -->
        
        <!-- T -->
        <path class="text-stroke"
          d="M480 20 L520 20 M500 20 L500 80"
          stroke="url(#textGradient)" stroke-width="8" fill="none"
          stroke-linecap="round" stroke-linejoin="round" />

        <!-- R -->
        <path class="text-stroke"
          d="M545 80 L545 20 L575 20
             Q595 20 595 40
             Q595 55 575 55
             L545 55
             L595 80"
          stroke="url(#textGradient)" stroke-width="8" fill="none"
          stroke-linecap="round" stroke-linejoin="round" />

        <!-- A -->
        <path class="text-stroke"
          d="M620 80 L640 20 L660 80 M625 65 L655 65"
          stroke="url(#textGradient)" stroke-width="8" fill="none"
          stroke-linecap="round" stroke-linejoin="round" />

        <!-- D -->
        <path class="text-stroke"
          d="M685 20 L685 80
             Q715 80 715 80
             Q735 80 735 50
             Q735 20 715 20
             Q685 20 685 20"
          stroke="url(#textGradient)" stroke-width="8" fill="none"
          stroke-linecap="round" stroke-linejoin="round" />

        <!-- E -->
        <path class="text-stroke"
          d="M760 20 L760 80
             M760 20 L790 20
             M760 50 L785 50
             M760 80 L790 80"
          stroke="url(#textGradient)" stroke-width="8" fill="none"
          stroke-linecap="round" stroke-linejoin="round" />

        <!-- R -->
        <path class="text-stroke"
          d="M815 80 L815 20 L845 20
             Q865 20 865 40
             Q865 55 845 55
             L815 55
             L865 80"
          stroke="url(#textGradient)" stroke-width="8" fill="none"
          stroke-linecap="round" stroke-linejoin="round" />
      </g>
    </svg>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"></script>
  <script>
    function initFooterAnimation() {
      // Get all text stroke paths
      const textStrokes = document.querySelectorAll('.text-stroke');
      const bubbles = document.querySelectorAll('.bubble');
      
      // Set initial state for text strokes
      gsap.set(textStrokes, {
        strokeDasharray: '1000',
        strokeDashoffset: '1000',
        opacity: 0
      });
      
      // Set initial state for bubbles
      gsap.set(bubbles, {
        opacity: 0,
        scale: 0,
        y: 100
      });
      
      // Create timeline for animations
      const tl = gsap.timeline({
        paused: true,
        onComplete: function() {
          // Start continuous bubble floating animation after initial entrance
          startContinuousBubbleAnimation();
        }
      });
      
      // Add text drawing animation
      tl.to(textStrokes, {
        strokeDashoffset: 0,
        opacity: 1,
        duration: 2,
        stagger: 0.1,
        ease: "power2.inOut"
      });
      
      // Add bubble entrance animation with stagger
      tl.to(bubbles, {
        opacity: 0.8,
        scale: 1,
        y: 0,
        duration: 1.5,
        stagger: {
          each: 0.2,
          from: "random"
        },
        ease: "back.out(1.7)"
      }, "-=1"); // Start bubbles 1 second before text completes
      
      // Create Intersection Observer for scroll trigger
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            tl.play();
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.3, // Trigger when 30% of element is visible
        rootMargin: '0px 0px -100px 0px' // Trigger a bit earlier
      });
      
      // Start observing the animated footer text element
      const footerTextElement = document.querySelector('.animated-footer-text');
      if (footerTextElement) {
        observer.observe(footerTextElement);
      }
    }
    
    function startContinuousBubbleAnimation() {
      const bubbles = document.querySelectorAll('.bubble');
      
      bubbles.forEach((bubble, index) => {
        // Add continuous floating animation with different delays
        gsap.to(bubble, {
          y: -150,
          opacity: 0,
          scale: 0.8,
          duration: 8 + Math.random() * 4,
          repeat: -1,
          delay: index * 0.5,
          ease: "none",
          onRepeat: function() {
            // Reset bubble position when animation repeats
            gsap.set(bubble, {
              y: 100,
              opacity: 0,
              scale: 0
            });
            
            // Brief pause before starting float up again
            gsap.to(bubble, {
              opacity: 0.8,
              scale: 1,
              duration: 0.5,
              delay: Math.random() * 2,
              ease: "back.out(1.7)"
            });
          }
        });
        
        // Add subtle horizontal movement
        gsap.to(bubble, {
          x: "random(-20, 20)",
          duration: 3 + Math.random() * 2,
          repeat: -1,
          yoyo: true,
          ease: "sine.inOut"
        });
      });
    }
    
    // Initialize animation when DOM is loaded
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initFooterAnimation);
    } else {
      initFooterAnimation();
    }
  </script>
</body>
</html>
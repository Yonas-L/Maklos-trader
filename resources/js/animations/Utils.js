/**
 * Utility functions for animations
 */

/**
 * Split text into words for animation
 * @param {HTMLElement} element 
 * @returns {NodeList} The created word elements
 */
export const splitTextIntoWords = (element) => {
    if (!element) return [];

    const text = element.textContent.trim();
    const words = text.split(/\s+/);

    // Create word spans with proper spacing - simpler structure for better alignment
    element.innerHTML = words.map((word, index) => {
        if (!word) return '';
        const space = index < words.length - 1 ? ' ' : '';
        return `<span class="word-wrapper"><span class="word inline-block">${word}</span></span>${space}`;
    }).join('');

    return element.querySelectorAll('.word');
};

/**
 * Check if device is mobile
 * @returns {boolean}
 */
export const isMobile = () => {
    return window.innerWidth < 1024;
};

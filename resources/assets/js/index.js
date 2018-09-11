/**
 * Auto-submit components
 */
const autoSubmitElements = document.querySelectorAll('.submit-on-change');
for (let i = 0; i < autoSubmitElements.length; i++) {
    autoSubmitElements[i].onchange = function() {
        let parent = this;

        while (parent = parent.parentElement) {
            if (parent === document.body) {
                return;
            }

            if (parent.tagName.toLowerCase() === 'form') {
                parent.submit();
                return;
            }
        }
    };
}

/**
 * Enhance click experience
 */
const enhancableElements = document.querySelectorAll('.enhancable');
for (let i = 0; i < enhancableElements.length; i++) {
    const enhancedTarget =
        enhancableElements[i].querySelector('.enchance-target');

    if (enhancedTarget) {
        enhancableElements[i].onclick = (e) => {
            e.preventDefault();
            e.stopPropagation();

            location.href = enhancedTarget.href;
        };

        enhancableElements[i].classList.add('enhanced');
    }
}

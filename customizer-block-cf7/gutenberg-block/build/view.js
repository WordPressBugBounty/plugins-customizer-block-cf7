/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************!*\
  !*** ./src/view.js ***!
  \*********************/
document.addEventListener('DOMContentLoaded', function () {
  // Function to apply invalid styles to all .wpcf7-not-valid elements
  function applyInvalidStyles() {
    const invalidElements = document.querySelectorAll('.wpcf7-not-valid');
    // console.log("Applying invalid styles to elements:", invalidElements);

    invalidElements.forEach(function (element) {
      element.classList.add('invalid-style'); // Add the CSS class for invalid styling

      // Add a focus event listener to remove the invalid styles and class on focus
      element.addEventListener('focus', function handleFocus() {
        console.log("Focus detected on invalid element:", element);
        element.classList.remove('invalid-style'); // Remove the styling class
        element.classList.remove('wpcf7-not-valid'); // Remove the validation error class
        element.removeEventListener('focus', handleFocus); // Remove listener after it runs
      });
    });
  }

  // Function to clear invalid styles
  function clearInvalidStyles() {
    const invalidElements = document.querySelectorAll('.invalid-style');
    //console.log("Clearing invalid styles from elements:", invalidElements);

    invalidElements.forEach(function (element) {
      element.classList.remove('invalid-style'); // Remove the styling class
    });
  }

  const submitButton = document.querySelector('.wpcf7-submit');
  const form = document.querySelector('.wpcf7-form');
  if (form && submitButton) {
    // Get the computed background color of the submit button
    const backgroundColor = window.getComputedStyle(submitButton).backgroundColor;

    // Observe changes to the data-status attribute of the form
    const observer = new MutationObserver(mutations => {
      mutations.forEach(mutation => {
        if (mutation.type === 'attributes' && mutation.attributeName === 'data-status') {
          const status = form.getAttribute('data-status');
          // console.log("Form data-status changed to:", status);

          // Change text color when status is 'submitting'
          if (status === 'submitting') {
            submitButton.style.setProperty('color', backgroundColor, 'important');
          } else {
            // Remove the entire style attribute when status changes to anything else
            submitButton.removeAttribute('style');
          }
          if (status === 'invalid') {
            setTimeout(applyInvalidStyles, 100); // Apply styles after delay if invalid
          } else {
            clearInvalidStyles();
          }
        }
      });
    });

    // Start observing the data-status attribute for changes
    observer.observe(form, {
      attributes: true
    });
    //  console.log("Started observing data-status attribute on form");
  } else {
    // console.log("Form or submit button not found, observer not started");
  }
});
/******/ })()
;
//# sourceMappingURL=view.js.map
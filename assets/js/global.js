lucide.createIcons();

document.addEventListener("DOMContentLoaded", function() {

    const passwordInput = document.querySelector('input[name="password"]');
    const eyeIcon = document.querySelector('[data-lucide="eye"]');

    if (passwordInput && eyeIcon) {

        eyeIcon.style.cursor = "pointer";

        eyeIcon.addEventListener("click", function() {

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }

        });

    }

});
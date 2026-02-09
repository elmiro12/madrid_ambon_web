document.addEventListener('DOMContentLoaded', function () {
    // Handle Material Kit Input Group Outline behavior
    const inputs = document.querySelectorAll('.input-group-outline input, .input-group-outline textarea');
    inputs.forEach(input => {
        if (input.value) {
            input.parentElement.classList.add('is-filled');
        }
        input.addEventListener('focus', () => {
            input.parentElement.classList.add('focused', 'is-filled');
        });
        input.addEventListener('blur', () => {
            input.parentElement.classList.remove('focused');
            if (!input.value) {
                input.parentElement.classList.remove('is-filled');
            }
        });
    });
});

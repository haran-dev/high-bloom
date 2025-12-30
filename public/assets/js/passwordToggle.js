    const passwordInput = document.getElementById('password');
    const toggleCheckbox = document.getElementById('togglePasswordCheckbox');
    const toggleLabel = document.getElementById('togglePasswordLabel');

    toggleCheckbox.addEventListener('change', function () {
        if (this.checked) {
            passwordInput.type = 'text';
            toggleLabel.textContent = 'Hide Password';
        } else {
            passwordInput.type = 'password';
            toggleLabel.textContent = 'Show Password';
        }
    });
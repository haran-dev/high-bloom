class Validation {
    static validateForm(form) {
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return false;
        }

        form.classList.add('was-validated');
        return true;
    }
}

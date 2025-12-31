class NotificationHandler {

    static success(message) {
        NotificationHandler.show(message, 'success');
    }

    static error(message) {
        NotificationHandler.show(message, 'danger');
    }

    static info(message) {
        NotificationHandler.show(message, 'info');
    }

    static warning(message) {
        NotificationHandler.show(message, 'warning');
    }

    static show(message, type = 'primary') {
        const container = document.getElementById('toastContainer');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = `toast align-items-center text-bg-${type} border-0`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');

        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;

        container.appendChild(toast);

        const bsToast = new bootstrap.Toast(toast, {
            delay: 3500
        });

        bsToast.show();

        // auto remove after hide
        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });
    }

    static validation(errors) {
        if (!errors) return;

        // input.classList.remove('is-valid');

        Object.keys(errors).forEach(field => {
            const input = document.querySelector(`[name="${field}"]`);
            if (!input) return;

            input.classList.remove('is-valid');

            input.classList.add('is-invalid');


            // input.classList.add('is-invalid');

            let feedback = input.parentElement.querySelector('.invalid-feedback');
            if (!feedback) {
                feedback = document.createElement('div');
                feedback.className = 'invalid-feedback';
                input.parentElement.appendChild(feedback);
            }

            feedback.innerText = errors[field][0];
        });
    }
}

// expose globally
window.NotificationHandler = NotificationHandler;

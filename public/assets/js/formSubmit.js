import Validation from './validation.js';
import NotificationHandler from './notificationHandler.js';


export default class FormSubmit {
    static init() {
        document.addEventListener('click', (e) => {
            const button = e.target.closest('.submit-form');
            if (!button) return;
            e.preventDefault();
            const form = button.closest('form');
            if (!form) return;
            if (!Validation.validateForm(form)) return;
            FormSubmit.ajax(form, button);
        });
    }

    static async ajax(form, button) {
        const url = button.dataset.url;
        if (!url) return NotificationHandler.error('Submit URL not defined');
        const formData = new FormData(form);
        const originalText = button.innerHTML;
        const spinner = button.querySelector('.spinner-border');
        const text = button.querySelector('.btn-text');

        button.disabled = true;
        spinner.classList.remove('d-none');
        text.textContent = 'Loading ';

        try {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': token }
            });
            const data = await response.json();
            if (!response.ok) throw data;
            NotificationHandler.success(data.message || 'Success');
            if (data.redirect) window.location.href = data.redirect;
        } catch (error) {
            if (error.errors) {
                NotificationHandler.validation(error.errors);
                NotificationHandler.error(error.message || 'Validation failed');
                return;
            }
            NotificationHandler.error(error.message || 'Something went wrong');
        } finally {
            button.disabled = false;
            button.innerHTML = originalText;
        }
    }
}

class FormSubmit {

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
        if (!url) {
            NotificationHandler.error('Submit URL not defined');
            return;
        }

        const formData = new FormData(form);


        const originalText = button.innerHTML;
        button.disabled = true;

        const spinner = button.querySelector('.spinner-border');
        const text = button.querySelector('.btn-text');

        button.disabled = true;
        spinner.classList.remove('d-none');
        text.textContent = 'Loading ';

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            // ✅ SUCCESS
            NotificationHandler.success(data.message || 'Success');

            if (data.redirect) {
                window.location.href = data.redirect;
            }

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

document.addEventListener('DOMContentLoaded', () => {
    FormSubmit.init();
});

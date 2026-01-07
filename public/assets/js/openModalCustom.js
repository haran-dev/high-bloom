export default class openModalCustom {

    static open(url) {
        const modalContainer = document.getElementById('modal-view');
        if (!modalContainer) return;

        modalContainer.innerHTML = '';

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.text())
        .then(html => {
            modalContainer.innerHTML = html;

            const modal = new bootstrap.Modal(modalContainer);
            modal.show();
        })
        .catch(err => {
            console.error('Modal Load Error:', err);
        });
    }

    static init() {
        document.addEventListener('click', (e) => {
            const btn = e.target.closest('.add-data');
            if (!btn) return;

            const url = btn.dataset.url;
            if (!url) return;

            openModalCustom.open(url);
        });
    }
}

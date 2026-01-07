import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';



import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (window.location.protocol === 'https:'),
    disableStats: true,
});

// Listen for logged activities
const userId = document.head.querySelector('meta[name="user-id"]').content;

window.Echo.channel(`notifications.${userId}`)
    .listen('ActivityLogged', (e) => {
        console.log('New notification', e.notification);
        appendNotification(e.notification); // custom function to update dropdown
    });

function appendNotification(notification) {
    const container = document.querySelector('.notifications');
    if (!container) return;

    const li = document.createElement('li');
    li.classList.add('notification-item');
    li.innerHTML = `
        <i class="bi bi-check-circle text-success"></i>
        <div>
            <h4>${notification.title}</h4>
            <p>${notification.message}</p>
            <p>${notification.created_at}</p>
        </div>
    `;
    container.prepend(li);

    // Keep only 6 visible
    const items = container.querySelectorAll('.notification-item');
    if (items.length > 6) items[items.length - 1].remove();
}

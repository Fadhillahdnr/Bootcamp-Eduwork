import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.axios = axios;
window.Pusher = require('pusher-js');
window.Pusher = Pusher;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    wsHost: import.meta.env.VITE_PUSHER_HOST ?? window.location.hostname,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 6001,
    forceTLS: false,
    enabledTransports: ['ws', 'wss'],
});
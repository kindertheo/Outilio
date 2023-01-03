import './bootstrap';
import { createApp } from 'vue';
import { addComponents } from './services/components';
import { addDependencies } from './services/dependencies';
import 'v-calendar/dist/style.css';

window.axios.defaults.headers.post = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

const app = createApp({});

addComponents(app);
addDependencies(app);

app.mount('#app');

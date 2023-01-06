import './bootstrap';
import { createApp } from 'vue';
import { addComponents } from './services/components';
import { addDependencies } from './services/dependencies';
import 'v-calendar/dist/style.css';
import 'dropzone-vue/dist/dropzone-vue.common.css';
import { VueReCaptcha } from "vue-recaptcha-v3";


window.axios.defaults.headers.post = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

const app = createApp({});

addComponents(app);
addDependencies(app);
app.use(VueReCaptcha, { siteKey: "toto" });

app.mount('#app');

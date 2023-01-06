import store from './store';
import VCalendar from 'v-calendar';
import DropZone from 'dropzone-vue';
import Vue3Sanitize from "vue-3-sanitize";
import { VueReCaptcha } from 'vue-recaptcha-v3';

const dependencies = [
    [store, {}],
    [VCalendar, {}],
    [DropZone, {}],
    [Vue3Sanitize, {}],
    [VueReCaptcha, {
        siteKey: '6Lfjf9YjAAAAACh-HuvW_uUIzJY0qivRBss4n8Gp',
        loaderOptions: {
            autoHideBadge: true
        }
    }],
]

const addDependencies = (app) => {
    for(const dependencie of dependencies){
        app.use(dependencie[0], dependencie[1]);
    }
}

export { addDependencies };

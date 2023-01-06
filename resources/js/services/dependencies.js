import store from './store';
import VCalendar from 'v-calendar';
import DropZone from 'dropzone-vue';
import Vue3Sanitize from "vue-3-sanitize";

const dependencies = [
    store,
    VCalendar,
    DropZone,
    Vue3Sanitize
]

const addDependencies = (app) => {
    for(const dependencie of dependencies){
        app.use(dependencie);
    }
}

export { addDependencies };

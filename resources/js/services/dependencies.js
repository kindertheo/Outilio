import store from './store';
import VCalendar from 'v-calendar';
import DropZone from 'dropzone-vue';

const dependencies = [
    store,
    VCalendar,
    DropZone
]

const addDependencies = (app) => {
    for(const dependencie of dependencies){
        app.use(dependencie);
    }
}

export { addDependencies };

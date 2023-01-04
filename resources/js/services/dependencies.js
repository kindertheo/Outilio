import store from './store';
import VCalendar from 'v-calendar';

const dependencies = [
    store,
    VCalendar
]

const addDependencies = (app) => {
    for(const dependencie of dependencies){
        app.use(dependencie);
    }
}

export { addDependencies };

import VCalendar from 'v-calendar';

const dependencies = [
    VCalendar
]

const addDependencies = (app) => {
    for(const dependencie of dependencies){
        app.use(dependencie);
    }
}

export { addDependencies };

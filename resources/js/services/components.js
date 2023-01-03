import lastStringElement from "../utils/lastStringElement";
import kebabize from "../utils/kebabize";

const components = [

];

const addComponent = (app, component) => {
    const componentName = lastStringElement(component, '/');
    app.component(kebabize(componentName), require(`../${component}`).default);
}

const addComponents = (app) => {
    for(const component of components){
        addComponent(app, component);
    }
}

export { addComponents };

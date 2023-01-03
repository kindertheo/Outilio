import lastStringElement from "../utils/lastStringElement";
import camelToPascal from "../utils/camelToPascal";

const {createStore} = require("vuex");

const modules = [
    'orders/services/order',
    'products/services/product',
];

const modulesArrayToObject = () => {
    let modulesObject = {};

    for(const module of modules){
        const moduleName = lastStringElement(module, '/');
        const pascalCaseModuleName = camelToPascal(moduleName);

        modulesObject[`${pascalCaseModuleName}Store`] = require(`../modules/${module}`)[moduleName];

    }

    return modulesObject;
}

const store = createStore({
    modules: modulesArrayToObject()
});

export default store;

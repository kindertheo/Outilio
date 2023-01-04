import lastStringElement from "../utils/lastStringElement";
import kebabize from "../utils/kebabize";

const components = [
    'orders/OrdersView',
    'orders/components/OrderForm',
    'products/components/ProductCard',
    'products/components/ProductsList',
    'products/components/ProductForm',
    'products/EditProductView',
    'products/CreateProductView',
    'orders/CreateOrderView',
    'products/ProductsView',
    'products/components/ProductsTable',
    'products/components/ProductRow',
];

const addComponent = (app, component) => {
    const componentName = lastStringElement(component, "/");
    app.component(
        kebabize(componentName),
        require(`../modules/${component}`).default
    );
};

const addComponents = (app) => {
    for (const component of components) {
        addComponent(app, component);
    }
};

export { addComponents };

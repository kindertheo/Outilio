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
    'orders/components/OrdersTable',
    'orders/components/OrderRow',
    'products/components/ProductRow',
    'products/components/CurrencyInput',
    'products/components/ProductsPagination',
    'users/LoginView',
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

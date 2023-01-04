import axios from "axios";

export const product = {
    namespaced: true,
    state: () => ({
        products: [],
        product: {
            id: null,
            name: '',
            description: '',
            priceByDay: 0,
        },
    }),
    mutations: {
        setProducts(state, products) {
            state.products = products;
        },
        setProduct(state, product) {
            state.product = product;
        },
    },
    actions: {
        async createProduct({ getters }) {
            const product = getters.getProduct;

            await axios.post('/products', {
                product,
            });

            window.location.href = '/products';
        },
        async updateProduct({ getters }) {
            const product = getters.getProduct;

            await axios.put(`/products/${product.id}`, {
                product,
            });

            window.location.href = '/products';
        },
        async deleteProduct({ dispatch }, payload) {
            await axios.delete(`/products/${payload.productId}`);

            await dispatch('setProducts');
        },
        async setProducts({ commit, rootGetters }) {
            const order = rootGetters['OrderStore/getOrder'];

            const { data } = await axios.get('/all-products', {
                params: {
                    date: order.date,
                }
            });

            commit("setProducts", data);
        },
    },
    getters: {
        getProduct(state) {
            return state.product;
        },
        getProducts(state) {
            return state.products;
        },
    },
};

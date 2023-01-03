import axios from "axios";

export const product = {
    namespaced: true,
    state: () => ({
        products: [],
        product: {
            name: "",
            description: "",
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

            await axios.post("/products", {
                product,
            });

            window.location.href = "/products";
        },
        async updateProduct({ dispatch, getters }) {},
        async deleteProduct({ dispatch, getters }) {},

        async setProducts({ commit }) {
            const { data } = await axios.get("/all-products");
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

import axios from "axios";

export const product = {
    namespaced: true,
    state: () => ({
        products: [],
        product: {
            id: null,
            name: '',
            description: '',
            mobileDescription: '',
            priceByDay: 0
        },
        productImgFile: null,
        range: [0, 3]
    }),
    mutations: {
        setProducts(state, products) {
            state.products = products;
        },
        setProduct(state, product) {
            state.product = product;
        },
        setProductImgFile(state, imgFile) {
            state.productImgFile = imgFile;
        },
    },
    actions: {
        async createProduct({ getters }) {
            const product = getters.getProduct;
            const imgFile = getters.getProductImgFile;

            let formData = new FormData();
            formData.append('imgFile', imgFile);
            formData.append('product', JSON.stringify(product));

            await axios.post('/products', formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            });

            window.location.href = '/products';
        },
        async updateProduct({ getters }) {
            const product = getters.getProduct;
            const imgFile = getters.getProductImgFile;

            let formData = new FormData();
            formData.append('imgFile', imgFile);
            formData.append('product', JSON.stringify(product));

            await axios.post(`/products/${product.id}`, formData, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
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
        getProductImgFile(state) {
            return state.productImgFile;
        },
        getProducts(state) {
            return state.products;
        },
        getRange(state){
            return state.range;
        }
    },
};

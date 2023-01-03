import axios from "axios";

export const order = {
    namespaced: true,
    state: () => ({
        orders: [],
        order: {
            date: new Date(),
            deliveryOption: false,
            customerPhone: '',
            customerEmail: '',
            customerFirstname: '',
            customerLastname: '',
            price: 0,
            productsIds: []
        },
    }),
    mutations: {

    },
    actions: {
        async createOrder({dispatch, getters}){
            const order = getters.getOrder;

            const { data } = await axios.post('/orders', {
                order
            });

        },
        async updateOrder({dispatch, getters}){

        }
    },
    getters: {
        getOrder(state){
            return state.order;
        }
    }
}

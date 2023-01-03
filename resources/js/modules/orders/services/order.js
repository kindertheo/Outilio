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
            products: []
        },
    }),
    mutations: {

    },
    actions: {
        async createOrder({dispatch, getters}){

        },
        async updateOrder({dispatch, getters}){

        }
    },
    getters: {

    }
}

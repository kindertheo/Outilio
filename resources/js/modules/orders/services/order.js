import axios from "axios";
import getSum from "../../../utils/getSum";
import getPrice from "../../../utils/getPrice";

export const order = {
    namespaced: true,
    state: () => ({
        orders: [],
        order: {
            id: null,
            date: new Date(),
            deliveryOption: false,
            customerPhone: '',
            customerEmail: '',
            customerFirstname: '',
            customerLastname: '',
            isAccepted: false,
            isProcessed: false,
            acceptDeposit: false,
            products: []
        }
    }),
    mutations: {
        resetOrder(state){
            state.order.id = null;
            state.order.date = new Date();
            state.order.deliveryOption = false;
            state.order.customerPhone = '';
            state.order.customerEmail = '';
            state.order.customerFirstname = '';
            state.order.customerLastname = '';
            state.order.isAccepted = false;
            state.order.isProcessed = false;
            state.order.acceptDeposit = false;
            state.order.products = [];
        },
        setOrder(state, order){
            state.order = order;
        },
        setOrders(state, orders){
            state.orders = orders;
        }
    },
    actions: {
        async createOrder({ commit, getters }) {
            let order = getters.getOrder;

            order.price = getters.computedPrice;

            await axios.post("/orders", {
                order,
            });

            commit('resetOrder');
        },
        async updateOrder({ dispatch, commit, getters }) {
            const order = getters.getOrder;

            await axios.put(`/orders/${order.id}`, {
                order,
            });

            dispatch('setOrders');
            commit('resetOrder');
        },
        async setOrders({ commit }) {
            const { data } = await axios.get('/all-orders');

            commit('setOrders', data);
        },
    },
    getters: {
        getOrder(state) {
            return state.order;
        },
        getOrders(state){
            return state.orders;
        },
        getDiscountCoef(state){
            return 1 - (state.order.products.length * 8) / 100;
        },
        getOrderPrice(state){
            return getSum(
                state.order.products.map((product) => product.price_by_day)
            );
        },
        computedDiscount(state, getters){
            const price = getters.getOrderPrice;

            return price * (state.order.products.length * 0.05);
        },
        computedPrice(state, getters){
            const price = getters.getOrderPrice;

            const deliveryPrice = state.order.deliveryOption ? 2000 : 0;

            if (state.order.products.length < 2) return price + deliveryPrice;

            return (
                price - getters.computedDiscount +
                deliveryPrice
            );
        },
        getFormattedOrderPrice(state, getters) {
           return getPrice(getters.computedPrice);
        },
        getFormattedOrderDiscount(state, getters){
            return getPrice(getters.computedDiscount);
        }
    },
};

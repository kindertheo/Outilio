import axios from "axios";
import getSum from "../../../utils/getSum";
import getPrice from "../../../utils/getPrice";

export const order = {
    namespaced: true,
    state: () => ({
        orders: [],
        order: {
            date: new Date(),
            deliveryOption: false,
            customerPhone: "",
            customerEmail: "",
            customerFirstname: "",
            customerLastname: "",
            products: [],
        },
    }),
    mutations: {},
    actions: {
        async createOrder({ dispatch, getters }) {
            let order = getters.getOrder;

            order.price = getters.computedPrice;

            const { data } = await axios.post("/orders", {
                order,
            });
        },
        async updateOrder({ dispatch, getters }) {},
    },
    getters: {
        getOrder(state) {
            return state.order;
        },
        computedPrice(state){
            const price = getSum(
                state.order.products.map((product) => product.price_by_day)
            );

            const deliveryPrice = state.order.deliveryOption ? 2000 : 0;

            if (state.order.products.length < 2) return price + deliveryPrice;

            return (
                price * (1 - (state.order.products.length * 5) / 100) +
                deliveryPrice
            );
        },
        getOrderPrice(state, getters) {
           return getPrice(getters.computedPrice);
        },
    },
};

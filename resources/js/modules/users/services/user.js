import axios from "axios";

export const user = {
    namespaced: true,
    state: () => ({
        user: {
            email: '',
            password: ''
        }
    }),
    mutations: {

    },
    actions: {
        async login({ getters }) {
            const user = getters.getUser;

            await axios.post('/login', {
                user,
            });

            window.location.href = '/orders';
        },
    },
    getters: {
        getUser(state){
            return state.user;
        }
    },
};

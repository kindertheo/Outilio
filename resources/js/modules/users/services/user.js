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
        async login({ getters }, payload) {
            const user = getters.getUser;

            const { data } = await axios.post('/login', {
                user,
                token: payload.token
            });

            if(data[0] === 'success')
                window.location.href = '/orders';
        },
    },
    getters: {
        getUser(state){
            return state.user;
        }
    },
};

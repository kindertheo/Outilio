<template>
    <input type="email" v-model="user.email" />
    <input type="password" v-model="user.password" />
    <button type="button" @click="this.login()">
        Se connecter
    </button>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    name: "LoginView",
    computed: {
        ...mapGetters('UserStore', [
            'getUser'
        ]),
        user: {
            get(){
                return this.getUser;
            }
        }
    },
    methods: {
        ...mapActions('UserStore', [
            'login'
        ])
    }
}
</script>

<style scoped>

</style>

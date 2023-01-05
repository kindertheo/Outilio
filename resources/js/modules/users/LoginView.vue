<template>
    <div class="min-vh-100 d-flex justify-content-center align-items-center" style="background-color: #FF9900">
        <div class="bg-light rounded p-3 shadow-sm" style="min-width: 50vw;">
            <h2 class="d-flex align-content-start mb-4 mb-md-3" style="font-size: 20px; color: #000000;">Connexion administrateur</h2>

            <div class="form-floating mb-3">
                <input type="email" class="form-control shadow-none" id="email" placeholder="email" v-model="user.email">
                <label for="email">Adresse email</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control shadow-none mb-4 mb-md-0" id="password" placeholder="password" v-model="user.password">
                <label for="password">Mot de passe</label>
            </div>

            <div class="mt-3 text-end">
                <button type="button"
                        @click="this.login()"
                        :disabled="this.isFormInvalid"
                        class="btn btn-dark shadow-none"
                >
                    Se connecter
                </button>
            </div>
        </div>
    </div>
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

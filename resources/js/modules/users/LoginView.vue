<template>
    <section class="vh-100 gradient-custom" style="background-color: #FFA012">
        <div class="container py-5 h-50">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-light text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 p-md-4 text-center">
                            <div class="">
                                <h2 class="d-flex align-content-start mb-4 mb-md-3" style="font-size: 20px; color: #000000;">Connexion administrateur</h2>
                                <div class="form-floating mb-4">
                                    <input type="email" class="form-control shadow-none" id="email" placeholder="email" v-model="user.email">
                                    <label style="color: black" class="ms-3" for="email">Adresse email</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control shadow-none mb-4 mb-md-0" id="password" placeholder="password" v-model="user.password">
                                    <label style="color: black" class="ms-3" for="password">Mot de passe</label>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-outline-dark px-4" @click="this.login()" type="submit">Se connecter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

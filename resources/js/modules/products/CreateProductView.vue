<template>
    <div class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="bg-light rounded p-3 shadow-sm mt-3" style="min-width: 50vw;">
            <div class="d-flex mb-3">
                <h5 style="color: #FFA012" class="me-3 mb-0 fw-bold">Produits</h5>
                <div class="text-muted">
                    Création d'un produit
                </div>
            </div>

            <product-form />

            <div class="mt-3 text-end">
                <button type="button"
                        @click="this.createProduct()"
                        :disabled="this.isFormInvalid"
                        class="btn btn-success shadow-none"
                >
                    Valider
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "CreateProductView",
    methods: {
        ...mapActions('ProductStore', [
            'createProduct'
        ]),
    },
    computed: {
        ...mapGetters('ProductStore', [
            'getProduct'
        ]),
        isFormInvalid(){
            return this.getProduct.name.trim() === '' ||
                this.getProduct.name.trim().length < 3;
        }
    }
}
</script>

<style scoped>

</style>

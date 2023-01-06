<template>
    <div class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="bg-light rounded p-3 shadow-sm" style="min-width: 50vw;">
            <div class="d-flex mb-3">
                <h5 style="color: #FFA012" class="me-3 mb-0 fw-bold">Produits</h5>
                <div class="text-muted">
                    Modification d'un produit
                </div>
            </div>

            <product-form />

            <div class="mt-3 text-end">
                <button type="button"
                        @click="this.updateProduct()"
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
import {mapGetters, mapActions, mapMutations} from "vuex";

export default {
    name: "EditProductView",
    props: {
        product: Object,
    },
    created() {
        this.setProduct({
            id: this.product.id,
            name: this.product.name,
            description: this.product.description,
            mobileDescription: this.product.mobile_description,
            priceByDay: this.product.price_by_day / 100,
        });
    },
    computed: {
        ...mapGetters('ProductStore', [
            'getProduct'
        ]),
        isFormInvalid(){
            return this.getProduct.name.trim() === '' ||
                this.getProduct.name.trim().length < 3;
        }
    },
    methods: {
        ...mapActions('ProductStore', [
            'updateProduct'
        ]),
        ...mapMutations('ProductStore', [
            'setProduct'
        ]),
    },
};
</script>

<style scoped></style>

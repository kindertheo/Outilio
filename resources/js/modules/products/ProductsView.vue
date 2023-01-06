<template>
    <div class="min-vh-100 p-3">
        <div class="d-flex justify-content-between align-items-center bg-dark text-white rounded-top p-3">
            <h5 class="mb-0">
                <span class="fw-bold">Produits</span> ({{ this.getProducts.length }})
            </h5>

            <a href="/products/create" class="btn btn-light btn-sm shadow-none">
                Ajouter un produit
            </a>
        </div>
        <products-table/>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "ProductsView",
    async created() {
        await this.setProducts();
    },
    methods: {
        ...mapActions('ProductStore', [
            'setProducts'
        ]),
    },
    computed: {
        ...mapGetters('ProductStore', [
            'getProducts'
        ])
    }
}
</script>

<style scoped>

</style>

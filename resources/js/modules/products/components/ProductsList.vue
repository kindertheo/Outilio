<template>
    <div class="d-flex flex-column contain-product-list">
        <product-card
            v-for="product in products"
            :key="product.id"
            :product="product"
        ></product-card>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
    name: "ProductsList",
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
        ]),
        products: {
            get() {
                return this.getProducts;
            },
        },
    },
};
</script>

<style scoped></style>

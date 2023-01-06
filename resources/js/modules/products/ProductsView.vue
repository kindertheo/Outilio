<template>
    <a href="/products/create">
        Ajouter un produit
    </a>
    <products-table/>
</template>

<script>
import {mapActions} from "vuex";

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
}
</script>

<style scoped>

</style>

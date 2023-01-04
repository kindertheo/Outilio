<template>
    <product-form />
    <button type="button" @click="this.updateProduct()">Sauvegarder</button>
</template>

<script>
import {mapActions, mapMutations} from "vuex";

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
            priceByDay: this.product.price_by_day / 100,
        });
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

<template>
    <form>
        <label>Nom</label>
        <input type="text" v-model="product.name" />
        <label>Description</label>
        <input type="text" v-model="product.description" />
        <label>Prix à la journée</label>
        <input type="text" v-model="product.priceByDay" />
    </form>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
    name: "ProductForm",
    computed: {
        ...mapGetters('ProductStore', [
            'getProduct'
        ]),
        product: {
            get() {
                return this.getProduct;
            },
        },
    },
};
</script>

<style scoped></style>

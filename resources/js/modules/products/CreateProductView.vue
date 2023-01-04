<template>
    <product-form />
    <button type="button" @click="this.createProduct()">Enregistrer</button>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "CreateProductView",
    methods: {
        ...mapActions('ProductStore', [
            'createProduct'
        ]),
    },
}
</script>

<style scoped>

</style>

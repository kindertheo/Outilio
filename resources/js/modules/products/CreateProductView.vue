<template>
    <product-form />
    <button type="button" @click="this.createProduct()" :disabled="this.isFormInvalid">Enregistrer</button>
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

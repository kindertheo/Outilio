<template>
    <table>
        <tr>
            <th></th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix par jour</th>
            <th></th>
        </tr>
        <product-row v-for="product of this.getProducts" :product="product"/>
    </table>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "ProductsTable",
    computed: {
        ...mapGetters('ProductStore', [
            'getProducts'
        ]),
    },
}
</script>

<style scoped>

</style>

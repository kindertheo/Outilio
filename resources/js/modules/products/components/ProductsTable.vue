<template>
    <div class="container" style="height: 82vh">
        <div class="table-responsive mt-3 rounded">
            <table class="table table-light table-sm m-10px table-hover">
                <thead>
                <tr>
                    <th class="p-3"></th>
                    <th class="p-3">Nom</th>
                    <th class="p-3">Description</th>
                    <th class="p-3">Prix par jour</th>
                    <th class="p-3"></th>
                </tr>
                </thead>
                <tbody>
                    <product-row v-for="product of this.getProducts" :product="product"/>
                </tbody>
            </table>
        </div>
    </div>

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

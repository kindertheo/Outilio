<template>
    <div class="table-responsive shadow-sm rounded-bottom" style="height: 90vh">
        <table class="table table-sm table-hover">
            <thead style="position: sticky; top: 0px; background-color: #FFFFFF">
            <tr>
                <th class="p-3" style="width: 15%;"></th>
                <th class="p-3" style="width: 15%;">Nom</th>
                <th class="p-3" style="width: 25%;">Description</th>
                <th class="p-3" style="width: 15%;">Description Mobile</th>
                <th class="p-3" style="width: 15%;">Prix / Jour</th>
                <th class="p-3" style="width: 15%;"></th>
            </tr>
            </thead>
            <tbody>
            <product-row v-for="product of this.getProducts" :product="product"/>
            </tbody>
        </table>
    </div>
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

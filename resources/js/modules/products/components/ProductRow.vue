<template>
    <tr>
        <td>
            <img v-if="product.img_path" :src="product.img_path" style="max-height: 100px; max-width: 100px; height: auto; width: auto;"/>
        </td>
        <td>
            {{ product.name }}
        </td>
        <td>
            {{ product.description }}
        </td>
        <td>
            {{ getProductPrice(product.price_by_day) }}
        </td>
        <td>
            <a :href="`/products/${product.id}`">
                Modifier
            </a>
            <button @click="this.deleteProduct({productId: product.id})">
                Supprimer
            </button>
        </td>
    </tr>
</template>

<script>
import getPrice from "../../../utils/getPrice";
import {mapActions} from "vuex";

export default {
    name: "ProductRow",
    props: {
        product: Object
    },
    methods: {
        ...mapActions('ProductStore', [
            'deleteProduct'
        ]),
        getProductPrice(price){
            return getPrice(price);
        }
    }
}
</script>

<style scoped>

</style>

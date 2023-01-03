<template>
    <input
        type="checkbox"
        class="btn-check"
        :id="`btn-check-outlined-${product.id}`"
        :value="product.id"
        v-model="order.productsIds"
        autocomplete="off"
    />
    <label
        class="btn btn-outline-primary"
        :for="`btn-check-outlined-${product.id}`"
    >
        <p>{{ product.name }}</p>
        <p>{{ product.description }}</p>
        <p>{{ product.price_by_day / 100 }}</p>
    </label>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    name: "ProductCard",
    props: {
        product: Object,
    },
    computed: {
        ...mapGetters("OrderStore", ["getOrder"]),
        order: {
            get() {
                return this.getOrder;
            },
        },
    },
};
</script>

<style scoped></style>

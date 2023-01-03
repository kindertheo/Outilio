<template>
    <input
        type="checkbox"
        class="btn-check"
        :id="`btn-check-outlined-${product.id}`"
        :value="product"
        v-model="order.products"
        autocomplete="off"
    />
    <label
        class="btn btn-outline-primary"
        :for="`btn-check-outlined-${product.id}`"
    >
        {{ product.name }}
        {{ product.description }}
        {{ product.price_by_day / 100 }}
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

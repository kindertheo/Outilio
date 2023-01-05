<template>
    <input
        type="checkbox"
        class="btn-check"
        :id="`btn-check-outlined-${product.id}`"
        :value="product"
        v-model="order.products"
        autocomplete="off"
        :disabled="!product.is_available"
    />
    <label
        class="btn btn-outline-primary"
        :for="`btn-check-outlined-${product.id}`"
    >
        {{ product.name }}
        {{ product.description }}
        {{ product.price_by_day / 100 }}
        <div v-if="!product.is_available">NON DISPO</div>
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

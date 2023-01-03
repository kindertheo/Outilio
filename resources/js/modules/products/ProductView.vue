<template>
    <product-form />
</template>

<script>
import { mapMutations } from "vuex";

export default {
    name: "ProductView",
    props: {
        product: Object,
    },
    created() {
        this.setProduct({
            name: this.product.name,
            description: this.product.description,
            priceByDay: this.product.price_by_day / 100,
        });
    },
    methods: {
        ...mapMutations("ProductStore", ["setProduct"]),
    },
};
</script>

<style scoped></style>

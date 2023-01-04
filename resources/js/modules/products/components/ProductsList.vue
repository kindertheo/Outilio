<template>
    <div class="d-flex flex-column contain-product-list">
        <product-card/>
        <product-card/>
        <product-card/>
        <product-card/>
        <product-card/>
        <product-card/>
        <product-card/>
    </div>
</template>

<script>
import ProductCard from "./ProductCard";
export default {
    name: "ProductsList",
    components: {ProductCard}
}
</script>

<style scoped>

</style>

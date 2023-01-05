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
    <label class="btn d-flex flex-row align-items-center rounded justify-content-between product-card mb-3" :for="`btn-check-outlined-${product.id}`">
        <div class="w-75 col-10 ms-3 text-start" style="color: #251749">
            <div class="d-flex flex-row">
                <div class="me-3">
                    <h5 class="title-product-card">{{ product.name }}</h5>
                </div>
                <div v-if="!product.is_available">
                    <span class="badge bg-danger">Non disponible ce jour</span>
                </div>
            </div>
            <p class="price-product-card"><strong>{{ product.price_by_day / 100 }}</strong> / jours</p>
            <p class="product-card-desc">{{ product.description }}</p>
        </div>
        <div class="col-2 me-3">
            <img :src="product.img_path" class="img-fluid img-product-card" alt="">
        </div>
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

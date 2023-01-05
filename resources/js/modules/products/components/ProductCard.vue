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
    <label class="btn rounded product-card mb-3 p-3 d-flex justify-content-between" :for="`btn-check-outlined-${product.id}`">
        <div class="d-flex flex-column">
            <div class="d-flex align-items-center mb-1">
                <h5 class="mb-0 me-3">{{ product.name }}</h5>
                <div v-if="!product.is_available">
                    <span class="badge bg-danger">Non disponible ce jour</span>
                </div>
                <div v-else>
                    <span class="badge bg-success">Disponible</span>
                </div>
            </div>
            <div class="text-start d-flex mb-3">
                <div class="fw-bold me-1">
                    {{ getProductPrice(product.price_by_day) }}
                </div>
                <div>
                    / jour
                </div>
            </div>
            <p class="text-start">
                {{ product.description }}
            </p>
        </div>

        <div class="my-auto me-3">
            <img :src="product.img_path" style="max-height: 75px; max-width: 75px; height: auto; width: auto;">
        </div>
    </label>
</template>

<script>
import { mapGetters } from "vuex";
import getPrice from "../../../utils/getPrice";

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
    methods: {
        getProductPrice(price){
            return getPrice(price);
        }
    }
};
</script>

<style scoped></style>

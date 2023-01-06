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
        class="btn rounded product-card mb-3 p-3 position-relative d-flex align-items-center justify-content-between"
        :for="`btn-check-outlined-${product.id}`"
        :id="`product-${product.id}`"
        :data-price="product.price_by_day / 100"
    >
        <div class="d-flex flex-column w-100">
            <div class="d-flex flex-column me-3">
                <div class="d-flex align-items-center">
                    <div class="d-block text-start d-xl-none">
                        <h6 class="mb-0 fw-bold">{{ product.name }}</h6>
                    </div>

                    <div class="d-none d-xl-block">
                        <h5 class="mb-0 fw-bold">{{ product.name }}</h5>
                    </div>
                </div>
                <div class="text-start d-flex mb-3">
                    <div class="fw-bold me-1">
                        {{ getProductPrice(product.price_by_day) }}
                    </div>
                    <div>/ jour</div>
                </div>
            </div>

            <p
                class="text-start d-xl-none"
                v-html="$sanitize(product.description)"
                style="
                    -webkit-line-clamp: 3;
                    display: -webkit-box;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    font-size: 12px;
                "
            ></p>

            <p
                class="text-start d-none d-xl-block"
                v-html="$sanitize(product.description)"
                style="
                    -webkit-line-clamp: 3;
                    display: -webkit-box;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                "
            ></p>
        </div>

        <div class="my-auto me-3" v-if="product.img_path">
            <img
                :src="product.img_path"
                style="
                    max-height: 75px;
                    max-width: 75px;
                    height: auto;
                    width: auto;
                "
                :alt="product.name"
            />
        </div>

        <div
            class="rounded-circle position-absolute top-0 end-0 me-3 mt-3 d-flex align-items-center justify-content-center"
            style="width: 17px; height: 17px; background-color: #ff9900"
            v-if="order.products.includes(product)"
        >
            <i class="fa-solid fa-check fa-2xs text-white"></i>
        </div>

        <div
            class="position-absolute top-0 end-0 me-3 mt-3"
            v-if="!product.is_available"
        >
            <span class="badge bg-danger">Non disponible</span>
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
        getProductPrice(price) {
            return getPrice(price);
        },
    },
};
</script>

<style scoped></style>

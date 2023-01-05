<template>
    <div>
        <div class="form-check mb-1">
            <input class="form-check-input shadow-none cursor-pointer" type="checkbox" v-model="checkAllProducts" id="checkbox-1" style="scale: 0.85;">
            <label class="form-check-label" for="checkbox-1" style="font-size: 14px; color: #8A8A8A;">
                Tout sélectionner
            </label>
        </div>

        <div class="d-flex flex-column contain-product-list">
            <product-card
                v-for="product in products"
                :key="product.id"
                :product="product"
            ></product-card>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations } from "vuex";
export default {
    name: "ProductsList",
    async created() {
        await this.setProducts();
    },
    data(){
        return {
            checkAllProducts: false,
        }
    },
    watch: {
        checkAllProducts(value) {
            let order = this.getOrder;

            order.products = value ? this.getProducts : [];

            this.setOrder(order);
        }
    },
    methods: {
        ...mapActions('ProductStore', [
            'setProducts'
        ]),
        ...mapMutations('OrderStore', [
            'setOrder'
        ]),
    },
    computed: {
        ...mapGetters('ProductStore', [
            'getProducts'
        ]),
        ...mapGetters('OrderStore', [
            'getOrder'
        ]),
        products: {
            get() {
                return this.getProducts;
            },
        },
    },
};
</script>

<style scoped></style>

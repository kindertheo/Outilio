<template>
    <div>
        <div class="d-flex justify-content-between mb-3">
            <div class="form-check">
                <input class="form-check-input shadow-none cursor-pointer" type="checkbox" v-model="checkAllProducts" id="checkbox-1" style="scale: 0.85;">
                <label class="form-check-label" for="checkbox-1" style="font-size: 14px; color: #8A8A8A;">
                    Tout sélectionner
                </label>
            </div>

            <products-pagination/>
        </div>

        <div class="d-flex flex-column contain-product-list">
            <product-card
                v-for="product in products.slice(this.getRange[0], this.getRange[1])"
                :key="product.id"
                :product="product"
            ></product-card>
        </div>

        <div class="d-flex justify-content-end">
            <products-pagination/>
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

            order.products = value ? this.getProducts.filter(product => product.is_available) : [];

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
            'getProducts',
            'getRange'
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

<template>
    <div>
        Etape 1
        <v-date-picker
            v-model="order.date"
            @dayclick="updateProducts"
            :min-date="new Date()"
        >
            <template v-slot="{ inputValue, togglePopover }">
                <div class="flex items-center">
                    <button class="" @click="togglePopover()">
                        <i class="fa fa-calendar"></i>
                    </button>
                    <input :value="inputValue" readonly />
                </div>
            </template>
        </v-date-picker>

        <div>
            Etape 2 <br />
            Une réduction est appliquée dès 2 outils selectionnés
            <products-list />
        </div>

        <div>
            Etape 3
            <label>Nom</label>
            <input
                type="text"
                v-model="order.customerLastname"
                id="firstname"
            />

            <label>Prénom</label>
            <input
                type="text"
                v-model="order.customerFirstname"
                id="lastname"
            />

            <label>Téléphone</label>
            <input type="tel" v-model="order.customerPhone" id="phone" />

            <label>Email</label>
            <input type="email" v-model="order.customerEmail" id="email" />

            <label>Livraison</label>
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="deliveryOptionFree"
                    :value="false"
                    v-model="order.deliveryOption"
                />
                <label class="form-check-label" for="deliveryOptionFree">
                    Livraison gratuite
                </label>
            </div>
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="deliveryOptionPaid"
                    :value="true"
                    v-model="order.deliveryOption"
                />
                <label class="form-check-label" for="deliveryOptionPaid">
                    Livraison payante
                </label>
            </div>
        </div>

        <div>
            Etape 4 - Récapitulatif

            <div
                v-for="product in order.products"
                :key="product.id"
                :id="`product-${product.id}`"
            >
                {{ product.name }}
                {{ this.getProductPrice(product.price_by_day) }}
            </div>

            <div id="deliveryPrice" v-if="this.getOrder.deliveryOption">
                Livraison : 20€
            </div>

            <div id="discount" v-if="this.getOrder.products.length >= 2">
                Réduction : -{{ this.getFormattedOrderDiscount }}
            </div>

            <div id="price">
                Montant total : {{ this.getFormattedOrderPrice }}
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import getPrice from "../../../utils/getPrice";

export default {
    name: "OrderForm",
    computed: {
        ...mapGetters("OrderStore", [
            "getOrder",
            "getFormattedOrderPrice",
            "getFormattedOrderDiscount",
        ]),
        order: {
            get() {
                return this.getOrder;
            },
        },
    },
    methods: {
        ...mapActions("ProductStore", ["setProducts"]),
        getProductPrice(price) {
            return getPrice(price);
        },
        async updateProducts() {
            await this.setProducts();
        },
    },
};
</script>

<style scoped></style>

<template>
    <div>
        Etape 1
        <v-date-picker v-model="order.date" @dayclick="updateProducts" :min-date='new Date()'>
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
            <input type="text" v-model="order.customerLastname" />

            <label>Prénom</label>
            <input type="text" v-model="order.customerFirstname" />

            <label>Téléphone</label>
            <input type="text" v-model="order.customerPhone" />

            <label>Email</label>
            <input type="text" v-model="order.customerEmail" />

            <label>Livraison</label>
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault1"
                    :value="false"
                    v-model="order.deliveryOption"
                />
                <label class="form-check-label" for="flexRadioDefault1">
                    Livraison gratuite
                </label>
            </div>
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault2"
                    :value="true"
                    v-model="order.deliveryOption"
                />
                <label class="form-check-label" for="flexRadioDefault2">
                    Livraison payante
                </label>
            </div>
        </div>

        <div>
            Etape 4 - Récapitulatif

            <div v-for="product in order.products" :key="product.id">
                {{ product.name }} {{ this.getProductPrice(product.price_by_day) }}
            </div>

            <div v-if="this.getOrder.deliveryOption">
                Livraison : 20€
            </div>

            <div v-if="this.getOrder.products.length >= 2">
                Réduction : -{{ this.getFormattedOrderDiscount }}
            </div>

            <div>
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
        ...mapGetters('OrderStore', [
            'getOrder',
            'getFormattedOrderPrice',
            'getFormattedOrderDiscount'
        ]),
        order: {
            get() {
                return this.getOrder;
            },
        },
    },
    methods: {
        ...mapActions('ProductStore', [
            'setProducts'
        ]),
        getProductPrice(price){
            return getPrice(price);
        },
        async updateProducts(){
            await this.setProducts();
        }
    },
};
</script>

<style scoped></style>

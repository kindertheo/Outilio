<template>
    <div>
        Etape 1
        <v-date-picker v-model="order.date">
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
            <input type="text" v-model="order.customerLastname" id="lastname" />

            <label>Prénom</label>
            <input
                type="text"
                v-model="order.customerFirstname"
                id="firstname"
            />

            <label>Téléphone</label>
            <input type="text" v-model="order.customerPhone" id="phone" />

            <label>Email</label>
            <input type="text" v-model="order.customerEmail" id="email" />

            <label>Livraison</label>
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="radio"
                    name="freeDeliveryOption"
                    id="freeDeliveryOption"
                    :value="false"
                    v-model="order.deliveryOption"
                />
                <label class="form-check-label" for="freeDeliveryOption">
                    Livraison gratuite
                </label>
            </div>
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="radio"
                    name="paidDeliveryOption"
                    id="paidDeliveryOption"
                    :value="true"
                    v-model="order.deliveryOption"
                />
                <label class="form-check-label" for="paidDeliveryOption">
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
                {{ product.name }} {{ product.price_by_day / 100 }}
            </div>

            <div id="discount">Réduction :</div>
            <div id="price">Montant total : {{ this.getOrderPrice }}</div>
            <button
                type="button"
                @click="createOrder"
                :disabled="this.isFormInvalid"
                id="submitOrder"
            >
                Valider
            </button>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import { product } from "../../products/services/product";

export default {
    name: "OrderForm",
    computed: {
        ...mapGetters("OrderStore", ["getOrder", "getOrderPrice"]),
        order: {
            get() {
                return this.getOrder;
            },
        },
        isFormInvalid() {
            return this.order.customerLastname === "" ||
                !this.order.customerLastname.match(/^[A-zÀ-ú]{3,}$/) ||
                this.order.customerFirstname === "" ||
                !this.order.customerFirstname.match(/^[A-zÀ-ú]{3,}$/) ||
                this.order.customerPhone === "" ||
                !this.order.customerPhone.match(
                    /^((\+)33|0)[1-9](\d{2}){4}$/
                ) ||
                this.order.customerEmail === "" ||
                !this.order.customerEmail.match(
                    /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/
                ) ||
                this.order.products.length === 0
                ? true
                : false;
        },
    },
    methods: {
        ...mapActions("OrderStore", ["createOrder"]),
    },
    components: { product },
};
</script>

<style scoped></style>

<template>
    <div class="row gx-3">
        <div class="col-12 col-xl-6 h-100 mb-3 mb-xl-0">
            <div class="bg-light rounded mb-3 p-3 shadow-sm">
                <div class="d-flex mb-3">
                    <h5 style="color: #FFA012" class="me-3 mb-0 fw-bold">Étape 1</h5>
                    <div class="text-muted">
                        Sélection de la date
                    </div>
                </div>

                <v-date-picker v-model="order.date" @dayclick="updateProducts" :min-date='new Date()' :is-required="true">
                    <template v-slot="{ inputValue, inputEvents, togglePopover }">
                        <div class="d-flex align-items-center" @click="togglePopover" v-on="inputEvents">
                            <div class="px-2 py-1" style="border: solid 1px #DCDCDC">
                                <svg
                                    class="text-gray-600 w-4 h-full mx-2 absolute pointer-events-none"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    width="19px"
                                    color="#B4B6B8"
                                    style="margin-bottom: 1px"
                                >
                                    <path
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    ></path>
                                </svg>
                            </div>

                            <input
                                class="px-2 py-1"
                                :value="inputValue"
                                style="background-color: #FFFFFF; border: solid 1px #DCDCDC; color: #919192"
                                readonly
                            />
                        </div>
                    </template>
                </v-date-picker>
            </div>

            <div class="bg-light rounded p-3 shadow-sm">
                <div class="d-flex mb-3">
                    <h5 style="color: #FFA012" class="me-3 mb-0 fw-bold">Étape 2</h5>
                    <div class="text-muted">
                        Sélection des outils
                    </div>
                </div>

                <products-list/>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="bg-light rounded p-3 h-100 shadow-sm">
                <div class="d-flex mb-3">
                    <h5 style="color: #FFA012" class="me-3 mb-0 fw-bold">Étape 3</h5>
                    <div class="text-muted">
                        Vos informations
                    </div>
                </div>

                <div class="d-flex w-100 mb-3">
                    <div class="form-floating w-50 me-3">
                        <input type="text" class="form-control shadow-none" id="lastname" placeholder="name" v-model="order.customerLastname">
                        <label for="lastname">Nom</label>
                    </div>
                    <div class="form-floating w-50">
                        <input type="text" class="form-control shadow-none" id="firstname" placeholder="firstname" v-model="order.customerFirstname">
                        <label for="firstname">Prénom</label>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input type="tel" class="form-control shadow-none" id="phone" placeholder="phone" v-model="order.customerPhone">
                    <label for="phone">Téléphone</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control shadow-none" id="email" placeholder="mail" v-model="order.customerEmail">
                    <label for="email">Adresse email</label>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input cursor-pointer shadow-none" type="checkbox" v-model="order.acceptDeposit" id="checkbox-2">
                    <label class="form-check-label" for="checkbox-2" style="font-size: 14px; color: #8A8A8A;">
                        Je m’engage à préparer une caution de 200 euros en espèces ainsi qu’une photocopie de ma pièce   d’identité pour le jour du rendez-vous.
                    </label>
                </div>

                <h5 class="text-muted">
                    Livraison
                </h5>

                <div class="row mt-1 ms-1">
                    <div class="form-check">
                        <input class="form-check-input cursor-pointer shadow-none" type="radio" name="flexRadioDefault" id="freeDeliveryOption"
                               :value="false"
                               v-model="order.deliveryOption"
                        >
                        <label style="font-size: 14px; color: #8A8A8A;" class="form-check-label" for="freeDeliveryOption">
                            Livraison gratuite dans un secteur de 5km autour de Metz
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input cursor-pointer shadow-none" type="radio" name="flexRadioDefault" id="paidDeliveryOption"
                               v-model="order.deliveryOption"
                               :value="true"
                        >
                        <label style="font-size: 14px; color: #8A8A8A;" class="form-check-label" for="paidDeliveryOption">
                            Livraison dans un secteur plus eloigné : 20,00 €
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations } from "vuex";
import getPrice from "../../../utils/getPrice";

export default {
    name: "OrderForm",
    computed: {
        ...mapGetters('OrderStore', [
            'getOrder',
            'getFormattedOrderPrice',
            'getFormattedOrderDiscount'
        ]),
        ...mapGetters('ProductStore', [
            'getProducts'
        ]),
        order: {
            get() {
                return this.getOrder;
            },
        },
    },
    methods: {
        ...mapMutations('OrderStore', [
            'setOrder'
        ]),
        ...mapActions('ProductStore', [
            'setProducts'
        ]),
        getProductPrice(price){
            return getPrice(price);
        },
        async updateProducts(){
            let order = this.order;

            await this.setProducts();

            const orderProductsIds = order.products.map(product => product.id);

            order.products = this.getProducts.filter(product => product.is_available && orderProductsIds.includes(product.id));

            this.setOrder(order);
        }
    },
};
</script>

<style scoped></style>

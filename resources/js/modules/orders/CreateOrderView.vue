<template>
    <div class="position-relative p-3">
        <order-form/>

        <div class="position-sticky sticky-bottom w-100 mt-3">
            <div class="bg-white d-flex p-3 rounded row align-items-center mx-auto w-100 shadow-sm">
                <div class="col-12 col-xl-3 mb-3 mb-xl-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            Livraison :
                        </div>
                        <div v-if="this.getOrder.deliveryOption" class="fw-bold ">
                            20,00 €
                        </div>
                        <div v-else class="fw-bold ">
                            Offerte
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between text-success" v-if="this.getOrder.products.length >= 2">
                        <div>
                            Réduction :
                        </div>
                        <div class="fw-bold ">
                            -{{ this.getFormattedOrderDiscount }}
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            Total :
                        </div>
                        <div class="fw-bold ">
                            {{ this.getFormattedOrderPrice }}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-9 text-end">
                    <button type="button"
                            class="btn btn-success shadow-none"
                            @click="storeOrder"
                            :disabled="this.isFormInvalid"
                            id="submitOrder"
                    >
                        Valider ma demande
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
import Swal from "sweetalert2";

export default {
    name: "CreateOrderView",
    computed: {
        ...mapGetters('OrderStore', [
            'getOrder',
            'getFormattedOrderPrice',
            'getFormattedOrderDiscount'
        ]),
        isFormInvalid() {
            return (
                this.getOrder.customerLastname === "" ||
                this.getOrder.customerLastname.length < 3 ||
                this.getOrder.customerFirstname === "" ||
                this.getOrder.customerFirstname.length < 3 ||
                this.getOrder.customerPhone === "" ||
                !this.getOrder.customerPhone.match(
                    /^((\+)33|0)[1-9](\d{2}){4}$/
                ) ||
                this.getOrder.customerEmail === "" ||

                !this.getOrder.acceptDeposit ||
                this.getOrder.products.length === 0 ||

                !this.getOrder.customerEmail.match(
                    /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/
                ) ||
                this.getOrder.products.length === 0
            );
        },
    },
    methods: {
        ...mapActions("OrderStore", ["createOrder"]),
        ...mapMutations("OrderStore", ["resetOrder"]),
        async storeOrder() {
            await this.createOrder();

            Swal.fire({
                title: "Votre réservation est prise en compte",
                text: "Nous reviendrons vers vous rapidement.",
                icon: "success",
            });
        },
    },
};
</script>

<style scoped></style>

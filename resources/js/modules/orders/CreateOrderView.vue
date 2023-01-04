<template>
    <order-form />
    <button
        type="button"
        @click="storeOrder"
        :disabled="this.isFormInvalid"
        id="submitOrder"
    >
        Valider
    </button>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
import Swal from "sweetalert2";

export default {
    name: "CreateOrderView",
    computed: {
        ...mapGetters("OrderStore", ["getOrder"]),
        isFormInvalid() {
            //regex include a minimum of 3 characters even with accents

            return (
                this.getOrder.customerLastname === "" ||
                !/^[A-zÀ-ÿ]{3,}$/.test(this.getOrder.customerLastname) ||
                this.getOrder.customerFirstname === "" ||
                !/^[A-zÀ-ÿ]{3,}$/.test(this.getOrder.customerFirstname) ||
                this.getOrder.customerPhone === "" ||
                !/^(0|\+33\+352)[1-9]([-. ]?[0-9]{2}){4}$/.test(
                    this.getOrder.customerPhone
                ) ||
                this.getOrder.customerEmail === "" ||
                !/^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/.test(
                    this.getOrder.customerEmail
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

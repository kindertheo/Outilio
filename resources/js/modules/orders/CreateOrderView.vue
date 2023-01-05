<template>
    <order-form />
    <button
        type="button"
        id="submitOrder"
        @click="storeOrder"
        :disabled="this.isFormInvalid"
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

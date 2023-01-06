<template>
    <tr>
        <td class="p-3">
            {{ order.customer_full_name }}
        </td>
        <td class="p-3">
            {{ order.customer_email }}
        </td>
        <td class="p-3">
            {{ order.customer_phone }}
        </td>
        <td class="p-3">
            <p style="margin-bottom: 0 !important;" v-for="product in order.products">
                {{ product.name }}
            </p>
        </td>
        <td class="p-3">
            {{ getOrderPrice(order.price) }}
        </td>
        <td class="p-3">
            {{ new Date(order.date).toLocaleDateString() }}
        </td>
        <td class="p-3">
            <div class="d-flex align-items-center" v-if="!order.is_processed && !order.is_ended">
                <button class="btn btn-sm btn-outline-danger me-1" type="button" @click="declineOrder">
                    Refuser
                </button>
                <button class="btn btn-sm btn-success" type="button" @click="acceptOrder">
                    Accepter
                </button>
            </div>

            <div class="d-flex flex-row align-items-center justify-content-evenly" v-else>
                <span class="badge bg-success" v-if="order.is_accepted">
                    Acceptée
                </span>
                <span class="badge bg-danger" v-else-if="order.is_processed">
                    Refusée
                </span>
                <div class="badge bg-warning text-dark" v-else>
                    Non traitée
                </div>
                <div class="text-muted text-decoration-underline ms-1" v-if="!order.is_ended" type="button" @click="cancelOrder">
                    Annuler
                </div>
            </div>
        </td>
    </tr>
</template>

<script>
import { mapActions, mapMutations } from "vuex";
import getPrice from "../../../utils/getPrice";

export default {
    name: "OrderRow",
    props: {
        order: Object
    },
    methods: {
        ...mapMutations('OrderStore', [
            'setOrder'
        ]),
        ...mapActions('OrderStore', [
            'updateOrder'
        ]),
        getOrderPrice(price){
            return getPrice(price);
        },
        async declineOrder(){
            const order = {
                id: this.order.id,
                date: new Date(this.order.date),
                deliveryOption: this.order.delivery_option,
                customerPhone: this.order.customer_phone,
                customerEmail: this.order.customer_email,
                customerFirstname: this.order.customer_firstname,
                customerLastname: this.order.customer_lastname,
                isAccepted: false,
                isProcessed: true,
                price: this.order.price,
                products: this.order.products
            };

            this.setOrder(order);

            await this.updateOrder();
        },
        async acceptOrder(){
            const order = {
                id: this.order.id,
                date: new Date(this.order.date),
                deliveryOption: this.order.delivery_option,
                customerPhone: this.order.customer_phone,
                customerEmail: this.order.customer_email,
                customerFirstname: this.order.customer_firstname,
                customerLastname: this.order.customer_lastname,
                isAccepted: true,
                isProcessed: true,
                price: this.order.price,
                products: this.order.products
            };

            this.setOrder(order);

            await this.updateOrder();
        },
        async cancelOrder(){
            const order = {
                id: this.order.id,
                date: new Date(this.order.date),
                deliveryOption: this.order.delivery_option,
                customerPhone: this.order.customer_phone,
                customerEmail: this.order.customer_email,
                customerFirstname: this.order.customer_firstname,
                customerLastname: this.order.customer_lastname,
                isAccepted: false,
                isProcessed: false,
                price: this.order.price,
                products: this.order.products
            };

            this.setOrder(order);

            await this.updateOrder();
        }
    }
}
</script>

<style scoped>

</style>

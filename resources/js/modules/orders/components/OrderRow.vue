<template>
    <tr>
        <td>
            {{ order.customer_full_name }}
        </td>
        <td>
            {{ order.customer_email }}
        </td>
        <td>
            {{ order.customer_phone }}
        </td>
        <td>
            Outils
        </td>
        <td>
            {{ getOrderPrice(order.price) }}
        </td>
        <td>
            {{ new Date(order.date).toLocaleDateString() }}
        </td>
        <td>
            <div v-if="!order.is_processed && !order.is_ended">
                <button type="button" @click="declineOrder">
                    Refuser
                </button>
                <button type="button" @click="acceptOrder">
                    Accepter
                </button>
            </div>

            <div v-else>
                <div v-if="order.is_accepted">
                    Acceptée
                </div>
                <div v-else-if="order.is_processed">
                    Refusée
                </div>
                <div v-else>
                    Non traitée
                </div>
                <button v-if="!order.is_ended" type="button" @click="cancelOrder">
                    Annuler
                </button>
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

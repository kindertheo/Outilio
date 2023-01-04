<template>
    <table>
        <thead>
            <tr>
                <th>Client</th>
                <th>Email</th>
                <th>Tél.</th>
                <th>Outils</th>
                <th>Prix</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="7">
                    A traiter
                </td>
            </tr>
            <order-row v-for="order of this.notProcessedOrder"
                       :order="order"
            />
        </tbody>
        <tbody>
        <tr>
            <td colspan="7">
                Non terminées
            </td>
        </tr>
        <order-row v-for="order of this.notEndedOrders"
                   :order="order"
        />
        </tbody>
        <tbody>
        <tr>
            <td colspan="7">
                Terminées
            </td>
        </tr>
        <order-row v-for="order of this.endedOrders"
                   :order="order"
        />
        </tbody>
    </table>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "OrdersTable",
    computed: {
        ...mapGetters('OrderStore', [
            'getOrders'
        ]),
        notProcessedOrder: {
            get(){
                return this.getOrders.filter(order => !order.is_processed && !order.is_ended);
            }
        },
        notEndedOrders: {
            get(){
                return this.getOrders.filter(order => order.is_processed && !order.is_ended);
            }
        },
        endedOrders: {
            get(){
                return this.getOrders.filter(order => order.is_ended);
            }
        }
    },
}
</script>

<style scoped>

</style>

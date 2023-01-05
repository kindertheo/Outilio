<template>
    <table class="table table-striped table-hover" style="height: 80vh">
        <thead>
            <td class="p-3">Client</td>
            <td class="p-3">Email</td>
            <td class="p-3">Tél.</td>
            <td class="p-3">Outils</td>
            <td class="p-3">Prix</td>
            <td class="p-3">Date</td>
        </thead>
        <tbody>
            <tr>
                <td colspan="7" class="fw-bold" style="color: #D80000">
                    A traiter
                </td>
            </tr>
            <order-row v-for="order of this.notProcessedOrder" :order="order" />
        </tbody>
        <tbody>
            <tr>
                <td colspan="7" class="fw-bold" style="color: #FFA012">
                    Non terminées
                </td>
            </tr>
            <order-row v-for="order of this.notEndedOrders" :order="order" />
        </tbody>
        <tbody>
        <tr>
            <td colspan="7" class="fw-bold" style="color: #009621">
                Terminées
            </td>
        </tr>
        <order-row v-for="order of this.endedOrders" :order="order" />
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

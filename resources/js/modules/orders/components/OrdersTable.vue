<template>
    <div class="table-responsive shadow-sm rounded-bottom" style="height: 90vh">
            <table class="table table-sm table-hover">
                <thead style="position: sticky; top: 0px; background-color: #FFFFFF">
                    <tr>
                        <th class="p-3">Client</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Tél.</th>
                        <th class="p-3">Outils</th>
                        <th class="p-3">Prix</th>
                        <th class="p-3">Date</th>
                        <th class="p-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="fw-bold text-start ps-3 bg-light" style="color: #D80000; height: 18px">
                            A traiter
                        </td>
                    </tr>
                    <order-row v-for="order of this.notProcessedOrder" :order="order" />
                </tbody>
                <tbody>
                    <tr>
                        <td colspan="7" class="fw-bold text-start ps-3 bg-light" style="color: #FFA012; height: 18px !important;">
                            Non terminées
                        </td>
                    </tr>
                    <order-row v-for="order of this.notEndedOrders" :order="order" />
                </tbody>
                <tbody>
                    <tr>
                        <td colspan="7" class="fw-bold text-start ps-3 bg-light" style="color: #009621; height: 18px">
                            Terminées
                        </td>
                    </tr>
                    <order-row v-for="order of this.endedOrders" :order="order" />
                </tbody>
            </table>
        </div>
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

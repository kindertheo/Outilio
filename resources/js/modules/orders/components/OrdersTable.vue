<template>
    <div class="container" style="height: 82vh">
        <div class="table-responsive mt-4 shadow-sm rounded" style="height: 78vh">
            <table class="table table-sm m-10px table-hover text-center">
                <thead style="position: sticky; top: 0px; background-color: #FFFFFF">
                    <tr>
                        <th class="p-3">Client</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Tél.</th>
                        <th class="p-3">Outils</th>
                        <th class="p-3">Prix</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="fw-bold text-start ps-4 bg-light" style="color: #D80000; height: 18px">
                            A traiter
                        </td>
                    </tr>
                    <order-row v-for="order of this.notProcessedOrder" :order="order" />
                </tbody>
                <tbody>
                    <tr>
                        <td colspan="7" class="fw-bold text-start ps-4 bg-light" style="color: #FFA012; height: 18px !important;">
                            Non terminées
                        </td>
                    </tr>
                    <order-row v-for="order of this.notEndedOrders" :order="order" />
                </tbody>
                <tbody>
                    <tr>
                        <td colspan="7" class="fw-bold text-start ps-4 bg-light" style="color: #009621; height: 18px">
                            Terminées
                        </td>
                    </tr>
                    <order-row v-for="order of this.endedOrders" :order="order" />
                </tbody>
            </table>
        </div>
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

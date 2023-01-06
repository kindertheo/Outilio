<template>
    <div class="min-vh-100 p-3">
        <div class="d-flex justify-content-between align-items-center bg-dark text-white rounded-top p-3">
            <h5 class="mb-0">
                <span class="fw-bold">Réservations</span> ({{ this.getOrders.length }})
            </h5>
        </div>
        <orders-table/>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "OrdersView",
    async created() {
        await this.setOrders();
    },
    methods: {
        ...mapActions('OrderStore', [
            'setOrders'
        ]),
    },
    computed: {
        ...mapGetters('OrderStore', [
            'getOrders'
        ])
    }
}
</script>

<style scoped>

</style>

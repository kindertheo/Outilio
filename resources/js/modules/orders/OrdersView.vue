<template>
    <orders-table/>
</template>

<script>
import {mapActions} from "vuex";

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
}
</script>

<style scoped>

</style>

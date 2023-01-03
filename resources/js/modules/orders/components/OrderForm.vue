<template>
    <form>
        Etape 1
        <v-date-picker v-model="order.date">
            <template v-slot="{ inputValue, togglePopover }">
                <div class="flex items-center">
                    <button
                        class=""
                        @click="togglePopover()"
                    >
                       <i class="fa fa-calendar"></i>
                    </button>
                    <input
                        :value="inputValue"
                        readonly
                    />
                </div>
            </template>
        </v-date-picker>

        Etape 3
        <label>Nom</label>
        <input type="text" v-model="order.customerLastname"/>

        <label>Prénom</label>
        <input type="text" v-model="order.customerFirstname"/>

        <label>Téléphone</label>
        <input type="text" v-model="order.customerPhone"/>

        <label>Email</label>
        <input type="text" v-model="order.customerEmail"/>

        <label>Livraison</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" :value="false" v-model="order.deliveryOption">
            <label class="form-check-label" for="flexRadioDefault1">
                Livraison gratuite
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" :value="true" v-model="order.deliveryOption">
            <label class="form-check-label" for="flexRadioDefault2">
                Livraison payante
            </label>
        </div>

        <button type="button" @click="createOrder">
            Valider
        </button>
    </form>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    name: "OrderForm",
    computed: {
        ...mapGetters('OrderStore', [
            'getOrder'
        ]),
        order: {
            get(){
                return this.getOrder;
            }
        }
    },
    methods: {
        ...mapActions('OrderStore', [
            'createOrder'
        ])
    }
}
</script>

<style scoped>

</style>

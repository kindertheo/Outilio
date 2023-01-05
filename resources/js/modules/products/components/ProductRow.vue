<template>
    <tr>
        <td>
            <img v-if="product.img_path" :src="product.img_path" style="max-height: 100px; max-width: 100px; height: auto; width: auto;"/>
        </td>
        <td>
            {{ product.name }}
        </td>
        <td>
            {{ product.description }}
        </td>
        <td>
            {{ getProductPrice(product.price_by_day) }}
        </td>
        <td>
            <a :href="`/products/${product.id}`">
                Modifier
            </a>
            <button @click="removeProduct">
                Supprimer
            </button>
        </td>
    </tr>
</template>

<script>
import getPrice from "../../../utils/getPrice";
import {mapActions} from "vuex";
import Swal from "sweetalert2";

export default {
    name: "ProductRow",
    props: {
        product: Object
    },
    methods: {
        ...mapActions('ProductStore', [
            'deleteProduct'
        ]),
        getProductPrice(price){
            return getPrice(price);
        },
        removeProduct(){

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger shadow-none',
                    cancelButton: 'btn btn-light shadow-none me-3'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas récupérer le produit par la suite.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d46868',
                cancelButtonColor: '#a1a1a1',
                cancelButtonText: 'Annuler',
                confirmButtonText: 'Oui, supprimer le produit.',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deleteProduct({productId: this.product.id});
                    Swal.fire(
                        'Supprimé!',
                        'Le produit a bien été supprimé',
                        'success'
                    )
                }
            });
        }
    }
}
</script>

<style scoped>

</style>

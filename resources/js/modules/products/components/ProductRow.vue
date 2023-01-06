<template>
    <tr>
        <td class="p-3 text-center">
            <img v-if="product.img_path" :src="product.img_path" style="max-height: 75px; max-width: 75px; height: auto; width: auto;"/>
        </td>
        <td class="p-3">
            {{ product.name }}
        </td>
        <td class="p-3">
            <p v-html="$sanitize(product.description)"
               style="-webkit-line-clamp: 3;display: -webkit-box;  -webkit-box-orient: vertical;overflow: hidden;">
            </p>
        </td>
        <td class="p-3">
            <p v-html="$sanitize(product.mobile_description)"
               style="-webkit-line-clamp: 3;display: -webkit-box;  -webkit-box-orient: vertical;overflow: hidden;">
            </p>
        </td>
        <td class="p-3">
            {{ getProductPrice(product.price_by_day) }}
        </td>
        <td class="p-3">
            <a :href="$sanitize(`/products/${product.id}`)" class="btn btn-sm btn-primary shadow-none me-1">
                <i class="fa fa-edit-pen"></i> Modifier
            </a>
            <button @click="removeProduct" class="btn btn-sm btn-danger shadow-none">
                <i class="fa fa-trash"></i>
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

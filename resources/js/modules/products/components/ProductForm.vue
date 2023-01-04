<template>
    <form>
        <label>Nom</label>
        <input type="text" v-model="product.name" />
        <label>Description</label>
        <input type="text" v-model="product.description" />
        <label>Prix à la journée</label>
        <input type="text" v-model="product.priceByDay" />
        <label>Image</label>
        <input type="file" @change="onFileChange" accept ="image/png, image/jpeg" />
    </form>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
export default {
    name: "ProductForm",
    computed: {
        ...mapGetters('ProductStore', [
            'getProduct'
        ]),
        product: {
            get() {
                return this.getProduct;
            },
        },
    },
    methods: {
        ...mapMutations('ProductStore', [
            'setProductImgFile'
        ]),
        onFileChange(e) {
            const files = e.target.files || e.dataTransfer.files;

            const imgFile = files.length ? files[0] : null;

            this.setProductImgFile(imgFile);
        },
    }
};
</script>

<style scoped></style>

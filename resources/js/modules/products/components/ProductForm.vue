<template>
    <form>
        <div class="form-floating mb-3">
            <input type="text" class="form-control shadow-none" id="name" placeholder="name" v-model="product.name">
            <label for="name">Nom</label>
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control shadow-none" placeholder="Description" id="floatingTextarea2" style="height: 150px; resize: none;" v-model="product.description"></textarea>
            <label for="floatingTextarea2">Description</label>
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control shadow-none" placeholder="Description pour mobile" id="floatingTextarea3" style="height: 100px; resize: none;" v-model="product.mobileDescription"></textarea>
            <label for="floatingTextarea3">Description pour mobile</label>
        </div>

        <currency-input
            class="mb-3"
            :options="{ currency: 'EUR', precision: 2 }"
            v-model="product.priceByDay"
            placeholder="Prix / Jour"
        />

        <DropZone
            @addedFile="onFileAdd"
            @removedFile="onFileRemove"
            :acceptedFiles="['png', 'jpg', 'jpeg']"
            :maxFiles="1"
            :uploadOnDrop="false"
            :multipleUpload="false"
        >
            <template v-slot:message>
                Glissez ou <span class='browse'>cliquez</span> pour ajouter une image du produit
            </template>
        </DropZone>
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
        onFileAdd(item){
            this.setProductImgFile(item.file);
        },
        onFileRemove(item){
            this.setProductImgFile(null);
        }
    }
};
</script>

<style scoped></style>

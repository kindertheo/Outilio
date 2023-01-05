<template>
    <div v-if="this.getProducts.length > 3" class="d-flex align-items-center" style="font-size: 14px;">
        <i :class="['fa-solid fa-chevron-left me-1', range[0] === 0 ? 'd-none' : 'cursor-pointer']"
           @click="prevPage"></i>
        <div>
            Page <span class="fw-bold">{{ this.currentPage  }}</span> sur {{ this.numberOfPages  }}
        </div>
        <i :class="['fa-solid fa-chevron-right cursor-pointer ms-1', range[1] === this.getProducts.length ? 'd-none' : 'cursor-pointer']"
           @click="nextPage"></i>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "ProductsPagination",
    computed: {
        ...mapGetters('ProductStore', [
            'getProducts',
            'getRange'
        ]),
        currentPage: {
            get(){
                return Math.ceil(this.range[0] / 3 + 1);
            }
        },
        numberOfPages: {
            get(){
                return Math.ceil(this.getProducts.length / 3);
            }
        },
        range: {
            get(){
                return this.getRange;
            }
        }
    },
    methods: {
        nextPage(){
            if(this.range[1] === this.getProducts.length)
                return;

            this.range[1] = this.getProducts.length < this.range[1] + 3 ? this.getProducts.length : this.range[1] + 3;
            this.range[0] = this.range[1] - 3;
        },
        prevPage(){
            if(this.range[0] === 0 )
                return;

            this.range[0] = this.range[0] - 3 < 0 ? 0 : this.range[0] - 3;

            this.range[1] = this.range[0] + 3;
        }
    }
}
</script>

<style scoped>

</style>

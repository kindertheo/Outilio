<template>
    <input type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off" disabled>
    <label class="btn d-flex flex-row align-items-center rounded justify-content-between product-card mb-3" for="btn-check-outlined">
        <div class="w-75 col-10 ms-3 text-start" style="color: #251749">
            <div class="d-flex flex-row">
                <div class="me-3">
                    <h5 class="title-product-card">Perceuse sans fil Bosh</h5>
                </div>
                <div>
                    <span class="badge bg-danger">Non disponible ce jour</span>
                </div>
            </div>
            <p class="price-product-card"><strong>10 €</strong> / jours</p>
            <p class="product-card-desc">Je m’engage à préparer une caution de 200 euros en espèces ainsi qu’une photocopie de ma pièce d’identité pour le jour</p>
        </div>
        <div class="col-2 me-3">
            <img src="../../../../../public/assets/perceuse.png" class="img-fluid img-product-card" alt="">
        </div>
    </label>
</template>

<script>
export default {
    name: "ProductCard"
}
</script>

<style scoped>

</style>

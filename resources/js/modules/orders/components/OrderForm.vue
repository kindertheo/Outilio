<template>
    <div class="d-flex w-100 py-3 px-5 mb-3" style="overflow: hidden; min-height: 90vh;">
        <div class="w-50 me-3">
            <div style="height: 17%" class="contain-step">
                <div class="d-flex h-25 pt-4 ps-4">
                    <div class="pe-3" style="color: #FFA012">
                        <h5 class="card-title">Étape 1</h5>
                    </div>
                    <div>
                        Sélection de la date
                    </div>
                </div>

                <div class="d-flex mt-3 h-75 pt-4 ps-4">
                    <v-date-picker v-model="date">
                        <template v-slot="{ inputValue, inputEvents }">
                            <div class=" d-flex align-items-center" style="background-color: #FFFFFF; ">
                                <div class="px-2 py-1" style="border: solid 1px #DCDCDC">
                                    <svg
                                        class="text-gray-600 w-4 h-full mx-2 absolute pointer-events-none"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        width="19px"
                                        color="#B4B6B8"
                                        style="margin-bottom: 1px"
                                    >
                                        <path
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        ></path>
                                    </svg>
                                </div>

                                <input
                                    class="px-2 py-1"
                                    :value="inputValue"
                                    v-on="inputEvents"
                                    style="background-color: #FFFFFF; border: solid 1px #DCDCDC; color: #919192"
                                />
                            </div>
                        </template>
                    </v-date-picker>
                </div>
            </div>
            <div style="height: 83%" class="mt-4 contain-step">
                <div class="d-flex pt-4 ps-4">
                    <div class="pe-3" style="color: #FFA012">
                        <h5 class="card-title">Étape 2</h5>
                    </div>
                    <div>
                        Sélection des outils
                    </div>
                </div>

                <div class="d-flex pt-4 ps-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox-1" style="scale: 0.85;">
                        <label class="form-check-label" for="checkbox-1" style="font-size: 14px; color: #8A8A8A;">
                            Tout sélectionner
                        </label>
                    </div>
                </div>
                <div class="pt-2 ps-4 mb-3 h-75" style="width: 98%">
                    <products-list/>
                </div>
            </div>
        </div>

        <div class="w-50">
            <div style="height: 65%" class="contain-step">
                <div class="d-flex pt-4 ps-4">
                    <div class="pe-3" style="color: #FFA012">
                        <h5 class="card-title">Étape 3</h5>
                    </div>
                    <div>
                        Vos informations
                    </div>
                </div>
                <div class="h-75 px-4 pt-4">
                    <div class="row">
                        <div class="form-floating mb-3 col-6">
                            <input type="text" class="form-control shadow-none" id="name" placeholder="name">
                            <label class="ms-3" for="name">Nom</label>
                        </div>
                        <div class="form-floating col-6">
                            <input type="text" class="form-control shadow-none" id="firstname" placeholder="firstname">
                            <label class="ms-3" for="firstname">Prénom</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-floating mb-3 col-12">
                            <input type="text" class="form-control shadow-none" id="phone" placeholder="phone">
                            <label class="ms-3" for="phone">Téléphone</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-floating mb-3 col-12">
                            <input type="text" class="form-control shadow-none" id="mail" placeholder="mail">
                            <label class="ms-3" for="mail">Adresse email</label>
                        </div>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center form-check">
                        <div>
                            <input class="form-check-input" type="checkbox" value="" id="checkbox-2" style="scale: 0.85;">
                        </div>
                        <div>
                            <label class="form-check-label" for="checkbox-2" style="font-size: 14px; color: #8A8A8A;">
                                Je m’engage à préparer une caution de 200 euros en espèces ainsi qu’une photocopie de ma pièce   d’identité pour le jour du rendez-vous.
                            </label>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <h5 style="color: #8A8A8A;">Livraison</h5>
                    </div>
                    <div class="row mt-1 ms-1">
                        <div class="form-check">
                            <input style="scale: 0.85;" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label style="font-size: 14px; color: #8A8A8A;" class="form-check-label" for="flexRadioDefault1">
                                Livraison Gratuite : Parking Intermarché MAGNY
                            </label>
                        </div>
                        <div class="form-check">
                            <input style="scale: 0.85;" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label style="font-size: 14px; color: #8A8A8A;" class="form-check-label" for="flexRadioDefault2">
                                20 € Livraison & retrait à domicile dans un rayon maximale qui l’on vous comfirmera
                            </label>
                        </div>
                    </div>


                </div>
            </div>

            <div style="height: 35%" class="mt-4 contain-step">
                <div class="d-flex h-25 pt-4 ps-4">
                    <div class="pe-3" style="color: #FFA012">
                        <h5 class="card-title">Étape 4</h5>
                    </div>
                    <div>
                        Récapitulatif
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProductsList from "../../products/components/ProductsList";
export default {
    name: "OrderForm",
    components: {ProductsList},
    data() {
        return {
            date: new Date(2020, 0, 6),
        };
    },
}
</script>

<style scoped>

</style>

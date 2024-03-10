<script setup>
import { ref } from "vue";
import LetsGetStarted from "./components/LetsGetStarted.vue";
import PersonalInformation from "./components/PersonalInformation.vue";
import AddressInformation from "./components/AddressInformation.vue";

/** @type {Ref<PseudoPage>} */
const page = ref("lets-get-started");

function onSubmitPersonalInfo(data) {
    console.log("Personal Information:", data);
    page.value = "address-info";
}

function onSubmitAddressInfo(data) {
    console.log("Address Information:", data);
}
</script>

<template>
    <transition name="fade" mode="out-in">
        <LetsGetStarted
            v-if="page === 'lets-get-started'"
            @proceed="page = 'personal-info'"
        />
        <PersonalInformation
            v-else-if="page === 'personal-info'"
            @proceed="page = 'address-info'"
            @back="page = 'lets-get-started'"
            @submit="onSubmitPersonalInfo"
        />
        <AddressInformation
            v-else-if="page === 'address-info'"
            @back="page = 'personal-info'"
            @submit="onSubmitAddressInfo"
        />
    </transition>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
.fade-enter-to,
.fade-leave-from {
    opacity: 1;
}
</style>

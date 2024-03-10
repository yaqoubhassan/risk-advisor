<script setup>
import { ref, watchEffect } from "vue";
import InsuranceOptions from "./InsuranceOptions.vue";
import InsuranceOption from "./InsuranceOption.vue";
import Button from "./common/IButton.vue";
import backgroundImage from "../../images/banner-4.jpg";

const emit = defineEmits(["proceed"]);

/** @type {Ref<ActiveInsuranceOption|null>} */
const activeOption = ref(null);

watchEffect(() => {
    console.log("activeOption:", activeOption.value);
});
</script>

<template>
    <div id="lets-get-started" class="pseudo-page">
        <div
            class="cover"
            :style="{ '--bg-img': 'url(' + backgroundImage + ')' }"
        />

        <main>
            <div class="container">
                <h1>Let's get started</h1>
                <p>
                    Please select one or more options below that you'd like to
                    have quoted for insurance.
                </p>

                <InsuranceOptions v-model="activeOption">
                    <InsuranceOption option="home">
                        Home
                        <template #description
                            >Your current or soon-to-be home</template
                        >
                    </InsuranceOption>

                    <InsuranceOption option="auto">
                        Auto
                        <template #description
                            >Your personal vehicle(s)</template
                        >
                    </InsuranceOption>

                    <InsuranceOption option="recreational-vehicle">
                        Recreational Vehicle
                        <template #description
                            >Your boat, RV, motorcycle, etc</template
                        >
                    </InsuranceOption>
                </InsuranceOptions>

                <Button class="mt-8" @click="emit('proceed')">
                    Agree and Continue
                </Button>

                <p class="text-gray-400 mt-4">
                    By continuing this form you agree to share data with Franke
                    Insurance Services as defined in the Terms of Use and
                    Privacy Policy.
                </p>
            </div>
        </main>
    </div>
</template>

<style scoped></style>

<script>
import Cookie from "js-cookie";
import InsuranceOptions from "../components/InsuranceOptions.vue";
import InsuranceOption from "../components/InsuranceOption.vue";
import Button from "../components/common/IButton.vue";
import banner from "../../images/banner-1.jpg";

export default {
    name: "LetsGetStartedRoute",
    components: {
        InsuranceOptions,
        InsuranceOption,
        Button,
    },
    inject: ["CONSTANTS"],
    data() {
        return {
            activeOptions: [],
            banner,
        };
    },
    computed: {
        formIsValid() {
            return this.activeOptions.length > 0;
        },
    },
    mounted() {
        this.activeOptions = JSON.parse(Cookie.get("insurance-options") ?? "[]");
    },
    methods: {
        submitInsuranceOptions() {
            if (this.formIsValid) {
                Cookie.set("insurance-options", JSON.stringify(this.activeOptions));
                this.$router.push("/personal-information");
            }
        },
    },
};
</script>

<template>
    <div id="lets-get-started" class="pseudo-page">
        <div class="cover" :style="`--bg-img: url(${banner})`"/>

        <main>
            <div class="container">
                <h1>Let's get started</h1>
                <p>
                    Please select one or more options below that you'd like to have quoted
                    for insurance.
                </p>

                <InsuranceOptions v-model="activeOptions">
                    <InsuranceOption option="home">
                        Home
                        <template #description>Your current or soon-to-be home</template>
                    </InsuranceOption>

                    <InsuranceOption option="auto">
                        Auto
                        <template #description>Your personal vehicle(s)</template>
                    </InsuranceOption>

                    <InsuranceOption option="recreational-vehicle">
                        Recreational Vehicle
                        <template #description>Your boat, RV, motorcycle, etc</template>
                    </InsuranceOption>
                </InsuranceOptions>

                <Button
                    class="mt-8"
                    :disabled="!formIsValid"
                    @click="submitInsuranceOptions"
                >
                    Agree and Continue
                </Button>

                <p class="text-gray-400 mt-4">
                    By continuing this form you agree to share data with Franke Insurance
                    Services as defined in the Terms of Use and Privacy Policy.
                </p>
            </div>
        </main>
    </div>
</template>

<style scoped></style>

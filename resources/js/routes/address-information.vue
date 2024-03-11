<script>
import z from "zod";
import Cookie from "js-cookie";
import Input from "../components/common/IInput.vue";
import Select from "../components/common/ISelect.vue";
import IButton from "../components/common/IButton.vue";
import { statesInUS, getAxiosErrorMessage } from "../utils.js";
import banner from "../../images/banner-3.jpg";

const AddressInformationSchema = z.object({
    street: z.string().min(2).optional(),
    apartment: z.string().min(1).optional(),
    city: z.string().min(2),
    zipCode: z.string().min(5),
    state: z.string().min(2),
});

export default {
    name: "AddressInformationRoute",
    components: {
        Input,
        Select,
        IButton,
    },
    data() {
        return {
            statesInUS,
            banner,

            street: "",
            apartment: "",
            city: "",
            zipCode: "",
            state: statesInUS[0].name,

            insuranceOptions: [],
            personalInfo: null,

            submitting: false,
        };
    },
    computed: {
        formIsValid() {
            const parsed = AddressInformationSchema.safeParse({
                // street: this.street,
                // apartment: this.apartment,
                city: this.city,
                zipCode: this.zipCode,
                state: this.state,
            });
            return parsed.success;
        },
    },
    mounted() {
        let insuranceOptions = JSON.parse(
            Cookie.get("insurance-options") ?? "[]"
        );
        if (insuranceOptions.length === 0) {
            this.$router.push("/");
            return;
        }

        let personalInfo = Cookie.get("personal-information");
        personalInfo = personalInfo ? JSON.parse(personalInfo) : null;

        if (!personalInfo) {
            this.$router.push("/personal-information");
            return;
        }

        this.personalInfo = personalInfo;
        this.insuranceOptions = insuranceOptions;
    },
    methods: {
        submitAddressInfo() {
            if (this.formIsValid) {
                const { street, apartment, city, zipCode, state } = this;
                const { email, firstName, lastName, phone, contactPreference } =
                    this.personalInfo;

                const selectedProducts = this.insuranceOptions.map((o) => {
                    const map = {
                        home: 1,
                        auto: 2,
                        "recreational-vehicle": 3,
                    };
                    return map[o];
                });

                const body = {
                    city,
                    email,
                    apartment,
                    state,
                    selectedProducts,
                    zip_code: zipCode,
                    phone_number: phone,
                    last_name: lastName,
                    first_name: firstName,
                    street_address: street,
                    contact_preference: contactPreference,
                };

                window.axios
                    .post(`/api/submissions`, body)
                    .then(() => {
                        Cookie.remove("insurance-options");
                        Cookie.remove("personal-information");
                        this.$router.push("/success");
                    })
                    .catch((error) => {
                        const message = getAxiosErrorMessage(error);
                        alert(message);
                    });
            }
        },
    },
};
</script>

<template>
    <div id="personal-information" class="pseudo-page">
        <div class="cover" :style="`--bg-img: url(${banner})`" />

        <form class="main" @submit.prevent="submitAddressInfo">
            <div class="container">
                <h1>Address Information</h1>
                <p>We can help with that! What is your address?</p>

                <div class="grid grid-cols-2 mt-8 gap-4">
                    <Input
                        v-model="street"
                        id="street-address"
                        label="Street address"
                        placeholder="Enter street address"
                        class="flex-grow"
                    />
                    <Input
                        v-model="apartment"
                        id="apt-number"
                        label="Ste/Apt"
                        placeholder="-"
                        class="flex-grow"
                    />
                </div>

                <Input
                    v-model="city"
                    id="city"
                    label="City *"
                    required
                    type="text"
                    placeholder="Enter city"
                />

                <Input
                    v-model="zipCode"
                    id="zip-code"
                    label="Zip code *"
                    required
                    type="text"
                    placeholder="Enter zip code"
                />

                <div>
                    <Select v-model="state" id="us-state" label="State *">
                        <option
                            v-for="stateInUS in statesInUS"
                            :value="stateInUS.name"
                        >
                            {{ stateInUS.name }}
                        </option>
                    </Select>
                </div>

                <IButton type="submit" class="mt-8" :disabled="!formIsValid">
                    Continue</IButton
                >

                <div class="mt-8 text-center">
                    <button
                        type="button"
                        class="text-blue-500 font-semibold hover:text-blue-700"
                        @click="$router.push('/personal-information')"
                    >
                        Back
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<style scoped></style>

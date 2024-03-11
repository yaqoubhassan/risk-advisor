<script>
import z from "zod";
import Cookie from "js-cookie";
import Input from "../components/common/IInput.vue";
import Select from "../components/common/ISelect.vue";
import IButton from "../components/common/IButton.vue";
import banner from "../../images/banner-2.jpg";

const PersonalInformationSchema = z.object({
    firstName: z.string().min(2),
    lastName: z.string().min(2),
    email: z.string().email(),
    phone: z.string().min(10),
    contactPreference: z.enum(["email", "phone"]),
});

export default {
    name: "PersonalInformationRoute",
    components: {
        Input,
        Select,
        IButton,
    },
    data() {
        return {
            firstName: '',
            lastName: '',
            email: '',
            phone: '',
            contactPreference: 'email',
            banner,
        }
    },
    computed: {
        formIsValid() {
            const parsed = PersonalInformationSchema.safeParse({
                firstName: this.firstName,
                lastName: this.lastName,
                email: this.email,
                phone: this.phone,
                contactPreference: this.contactPreference,
            });
            return parsed.success
        }
    },
    mounted() {
        let options = JSON.parse(Cookie.get("insurance-options") ?? "[]");
        if (options.length === 0) {
            this.$router.push("/");
            return
        }

        let form = Cookie.get("personal-information")
        form = form ? JSON.parse(form) : null;
        if (form) {
            this.firstName = form.firstName;
            this.lastName = form.lastName;
            this.email = form.email;
            this.phone = form.phone;
            this.contactPreference = form.contactPreference;
        }
    },
    methods: {
        submitPersonalInfo() {
            if (this.formIsValid) {
                Cookie.set("personal-information", JSON.stringify({
                    firstName: this.firstName,
                    lastName: this.lastName,
                    email: this.email,
                    phone: this.phone,
                    contactPreference: this.contactPreference,
                }));
                this.$router.push("/address-information");
            }
        }
    },
}

</script>

<template>
    <div id="personal-information" class="pseudo-page">
        <div class="cover" :style="`--bg-img: url(${banner})`"/>

        <form class="main" @submit.prevent="submitPersonalInfo">
            <div class="container">
                <h1>Personal Information</h1>
                <p>
                    Ok, great! Before we continue, please let us know how we can contact
                    you regarding your quote.
                </p>

                <div class="grid grid-cols-2 mt-8 gap-4">
                    <Input
                        v-model="firstName"
                        id="first-name"
                        label="First name *"
                        required
                        placeholder="Enter first name"
                    />
                    <Input
                        v-model="lastName"
                        id="last-name"
                        label="Last name *"
                        required
                        placeholder="Enter last name"
                    />
                </div>

                <Input
                    v-model="email"
                    id="email"
                    label="Email *"
                    required
                    type="email"
                    placeholder="Enter email address"
                />

                <Input
                    v-model="phone"
                    id="phone"
                    label="Phone *"
                    required
                    type="text"
                    placeholder="Enter phone number"
                />

                <div>
                    <Select
                        v-model="contactPreference"
                        id="contact-preference"
                        label="Contact preference *"
                        required
                    >
                        <option value="email" selected>Email</option>
                        <option value="phone">Phone</option>
                    </Select>
                </div>

                <IButton type="submit" class="mt-8" :disabled="!formIsValid"> Continue</IButton>

                <div class="mt-8 text-center">
                    <button
                        type="button"
                        class="text-blue-500 font-semibold hover:text-blue-700"
                        @click="$router.push('/')"
                    >
                        Back
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<style scoped></style>

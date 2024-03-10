<script setup>
import { ref } from "vue";
import Input from "./common/IInput.vue";
import Select from "./common/ISelect.vue";
import IButton from "./common/IButton.vue";

const emit = defineEmits(["proceed", "back", "submit"]);

const firstName = ref("");
const lastName = ref("");
const email = ref("");
const phone = ref("");

/** @type {Ref<'email'|'phone'>} */
const contactPreference = ref("email");

function submit() {
  emit("submit", {
    firstName: firstName.value,
    lastName: lastName.value,
    email: email.value,
    phone: phone.value,
    contactPreference: contactPreference.value,
  });
}
</script>

<template>
  <div id="personal-information" class="pseudo-page">
    <div class="cover" style="--bg-img: url(/banner-2.jpg)" />

    <form class="main" @submit.prevent="submit">
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

        <div class="">
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

        <IButton type="submit" class="mt-8"> Continue </IButton>

        <div class="mt-8 text-center">
          <button
            type="button"
            class="text-blue-500 font-semibold hover:text-blue-700"
            @click="emit('back')"
          >
            Back
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<style scoped></style>

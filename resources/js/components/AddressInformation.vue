<script setup>
import { ref } from "vue";
import Input from "./common/IInput.vue";
import Select from "./common/ISelect.vue";
import IButton from "./common/IButton.vue";
import { statesInUS } from "../utils.js";

const emit = defineEmits(["proceed", "back", "submit"]);

const street = ref("");
const apartment = ref("");
const city = ref("");
const zipCode = ref("");
const state = ref(statesInUS[0].id);

function submit() {
  emit("submit", {
    street: street.value,
    apartment: apartment.value,
    city: city.value,
    zipCode: zipCode.value,
    state: state.value,
  });
}
</script>

<template>
  <div id="personal-information" class="pseudo-page">
    <div class="cover" style="--bg-img: url(/banner-3.jpg)" />

    <form class="main" @submit.prevent="submit">
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
              v-for="(stateInUS, index) in statesInUS"
              :value="stateInUS.id"
            >
              {{ stateInUS.name }}
            </option>
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

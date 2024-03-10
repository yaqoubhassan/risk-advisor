<script setup>
import { provide } from "vue";

/** @type {ModelRef<ActiveInsuranceOption | null>} */
const model = defineModel({ required: true, default: null });

provide("insuranceOption", model);
</script>

<template>
  <div class="insurance-options">
    <slot />
  </div>
</template>

<style scoped>
.insurance-options {
  @apply mt-8;
}
</style>

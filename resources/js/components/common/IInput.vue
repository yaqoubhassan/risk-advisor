<script setup>
const model = defineModel({ required: true, default: "", type: String });
defineProps({
  id: {
    type: String,
    required: true,
  },
  /**
   * @type {'text'|'email'}
   */
  type: {
    type: String,
    default: "text",
    validator(value) {
      return ["text", "email"].includes(value);
    },
  },
  required: {
    type: Boolean,
    default: false,
  },
  label: {
    type: String,
    default: "",
  },
  placeholder: {
    type: String,
    default: "",
  },
});
</script>

<template>
  <div class="form-group">
    <label v-if="label" :for="id">{{ label }}</label>
    <input v-model="model" :id :type :required :placeholder />
  </div>
</template>

<style scoped>
.form-group {
  @apply mb-6;
}

input {
  @apply w-full py-3 px-4 rounded-xl border border-gray-300 outline-0;

  &:focus {
    @apply border-blue-500;
  }
}
</style>

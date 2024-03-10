<script setup>
const model = defineModel({ required: true, type: String });

const props = defineProps({
  id: {
    type: String,
    required: true,
  },
  required: {
    type: Boolean,
    default: false,
  },
  label: {
    type: String,
    default: "",
  },
});
</script>

<template>
  <div>
    <label v-if="label" :for="id">{{ label }}</label>
    <div class="select-wrapper">
      <select v-model="model" :id :required>
        <slot />
      </select>
    </div>
  </div>
</template>

<style scoped>
.select-wrapper {
  @apply relative;

  &::after {
    @apply absolute text-base top-[30%] right-4 pointer-events-none;
    content: url(/select-caret.svg);
  }
}

select {
  @apply block w-full py-3 px-4 rounded-xl border border-gray-300 outline-0 text-gray-400;
  appearance: none;

  &:focus {
    @apply border-blue-500;
  }
}
</style>

<script setup>
const props = defineProps({
  /**
   * @type {'button'|'submit'|'reset'}
   */
  type: {
    type: String,
    default: "button",
    validator(value) {
      return ["button", "submit", "reset"].includes(value);
    },
  },
});
</script>

<template>
  <button :type="props.type">
    <slot></slot>
  </button>
</template>

<style scoped>
button {
  @apply bg-blue-500 text-white py-3 px-4 rounded-xl w-full hover:bg-blue-600;
}
</style>

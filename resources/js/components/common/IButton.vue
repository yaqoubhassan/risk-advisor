s
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
    @apply text-white py-3 px-4 rounded-xl w-full;

    &:disabled {
        @apply bg-gray-300 cursor-not-allowed;
    }

    &:not(:disabled) {
        @apply cursor-pointer bg-blue-500 hover:bg-blue-600;
    }
}
</style>

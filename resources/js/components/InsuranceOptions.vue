<script>
import {computed,} from "vue";

export default {
    name: 'InsuranceOptions',
    props: {
        modelValue: {
            type: Array,
            default: () => []
        }
    },
    emits: ['update:modelValue'],
    computed: {
        value: {
            get() {
                return this.modelValue
            },
            set(value) {
                this.$emit('update:modelValue', value)
            }
        }
    },
    provide() {
        return {
            insuranceOptions: computed(() => this.value),
            setInsuranceOptions: (value) => this.value = value
        }
    }
}
</script>

<template>
    <div class="insurance-options">
        <slot/>
    </div>
</template>

<style scoped>
.insurance-options {
    @apply mt-8;
}
</style>

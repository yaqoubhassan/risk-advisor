<script>
import {PhCar, PhCheck, PhGearSix, PhHouse} from "@phosphor-icons/vue";

export default {
    name: "InsuranceOption",
    components: {
        PhCar,
        PhCheck,
        PhGearSix,
        PhHouse,
    },
    props: {
        option: {
            type: String,
            required: true,
            validator(value) {
                return ["home", "auto", "recreational-vehicle"].includes(value);
            },
        },
    },
    inject: ["insuranceOptions",'setInsuranceOptions'],
    computed: {
        active() {
            return this.insuranceOptions.includes(this.option);
        },
        icon() {
            let icon = PhHouse;
            if (this.option === "auto") {
                icon = PhCar;
            } else if (this.option === "recreational-vehicle") {
                icon = PhGearSix;
            }
            return icon;
        },
    },
    methods: {
        setActiveOption(option) {
            const alreadySelected = this.insuranceOptions.includes(option);
            if (alreadySelected) {
                const optionsWithoutOption = this.insuranceOptions.filter(
                    (o) => o !== option
                );
                this.setInsuranceOptions(optionsWithoutOption)
            } else {
                this.setInsuranceOptions([...this.insuranceOptions, option])
            }
        },
    },
}
</script>

<template>
    <div
        class="option"
        :class="{ active, [option]: true }"
        @click="setActiveOption(option)"
    >
    <span v-if="active">
      <PhCheck weight="bold" size="16px"/>
    </span>

        <div class="icon">
            <Component :is="icon" weight="fill" size="30px"/>
        </div>

        <div class="description">
            <p>
                <slot/>
            </p>
            <span><slot name="description"/></span>
        </div>
    </div>
</template>

<style scoped>
.option {
    @apply relative rounded-xl px-3 py-4 bg-cover bg-no-repeat cursor-pointer border-2 border-white overflow-hidden;
    @apply flex;
    background-position: 20% 80%;

    &.home {
        background-position: center;
    }

    &:not(:last-child) {
        @apply mb-4;
    }

    &.active {
        @apply border-2 border-blue-500;
    }

    & > span {
        @apply absolute top-0 right-0 w-7 h-7 bg-blue-500 text-white flex items-center justify-center rounded-bl-xl;
    }

    &::before {
        @apply absolute inset-0 rounded-xl;
        background: linear-gradient(
            to right,
            rgba(0, 16, 59, 0.91) 30%,
            rgba(0, 16, 59, 0.62),
            transparent
        );
        content: "";
    }

    & > * {
        @apply relative z-[2];
    }

    &:nth-child(1) {
        background-image: url(/images/mini-bg-1.jpg);
    }

    &:nth-child(2) {
        background-image: url(/images/mini-bg-2.jpg);
    }

    &:nth-child(3) {
        background-image: url(/images/mini-bg-3.jpg);
    }
}

.icon {
    @apply bg-blue-50 rounded-lg p-2 max-w-max text-blue-500;
}

.description {
    @apply text-white ml-3;

    p {
        @apply font-semibold;
    }

    span {
        @apply text-sm;
    }
}
</style>

<script>
import illustration from '../../images/done-illustraction.svg'
import IButton from "../components/common/IButton.vue";

export default {
    components: {
        IButton,
    },
    data() {
        return {
            illustration,
        }
    }
}
</script>

<template>
    <main class="w-screen h-screen flex items-center justify-center flex-col">
        <img :src="illustration" alt="Success" class="mx-auto w-[150px]" />
        <h1 class="text-3xl mt-12 text-center">
            Your submission was successful!
        </h1>

        <div class="text-center">
            <IButton @click="$router.push('/')" class="mt-12 max-w-max">
                Go back to home
            </IButton>
        </div>
    </main>
</template>

<style scoped>

</style>

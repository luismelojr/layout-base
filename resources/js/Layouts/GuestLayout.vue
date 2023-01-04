<script setup>
const props = defineProps({
    isLogin: {
        type: Boolean,
        default: true
    }
})
</script>

<template>
    <div class="tw-min-h-screen tw-flex tw-flex-col tw-bg-banner tw-bg-cover tw-bg-center tw-relative tw-justify-between">
        <div>
            <div class="block tw-w-full tw-px-4 tw-max-w-md xl:tw-px-0">
                <div class="tw-bg-white tw-shadow ">
                    <div class="tw-bg-indigo-500 tw-w-full tw-flex tw-justify-center tw-items-center tw-p-4">
                        <Link :href="route('login')">
                            <ApplicationLogo class="tw-h-12 tw-w-12 tw-text-white"/>
                        </Link>
                    </div>
                    <div class="tw-p-4">
                        <slot />
                    </div>
                </div>
                <span v-if="!props.isLogin" class="tw-mt-4 tw-text-center tw-text-gray-400 tw-block">Voltar para o <Link :href="route('login')" class="tw-font-bold">Log in</Link></span>
            </div>
        </div>
        <span class="tw-text-center tw-pb-4 tw-text-gray-400">© Melo Dev - <a href="https://www.linkedin.com/in/luis-henrique-da-silva-melo-junior-416579155/" target="_blank">Luis Henrique</a></span>
    </div>
    <Toasts />
</template>

<style scoped>
.block {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>

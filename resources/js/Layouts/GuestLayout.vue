<script setup>
</script>

<template>
    <div class="tw-min-h-screen tw-min-w-full tw-grid tw-grid-cols-2 tw-bg-gray-100">
        <div class="tw-py-[2.5rem] tw-px-[7rem] tw-flex tw-justify-between tw-flex-col">
            <div>
                <Link :href="route('login')">
                    <ApplicationLogo />
                </Link>
                <div class="tw-mt-[8rem]">
                    <slot />
                </div>
            </div>
            <span class="tw-text-center tw-pb-4 tw-text-gray-400">© Melo Dev - <a href="https://www.linkedin.com/in/luis-henrique-da-silva-melo-junior-416579155/" target="_blank">Luis Henrique</a></span>
        </div>
        <div class="tw-bg-hero-bg tw-bg-cover tw-bg-no-repeat tw-bg-center">
        </div>
    </div>
    <Toasts />
</template>

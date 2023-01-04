<script setup>
const props = defineProps({
    title: String,
    subtitle: String,
})
</script>

<template>
    <SlideOver position="right">
        <div class="tw-w-full tw-h-full tw-bg-white tw-flex tw-flex-col">
            <div class="tw-p-4 tw-bg-indigo-500">
                <h2 class="tw-text-lg tw-font-medium tw-text-white">{{props.title}}</h2>
                <div class="tw-mt-1">
                    <p class="tw-text-sm tw-text-indigo-300">{{props.subtitle}}</p>
                </div>
            </div>
            <div class="tw-p-4 tw-flex-1">
                <slot />
            </div>
        </div>
    </SlideOver>
</template>

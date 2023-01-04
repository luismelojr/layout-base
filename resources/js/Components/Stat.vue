<script setup>
const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    value: {
        type: String,
        required: true,
    },
})
</script>
<template>
    <div class="tw-flex tw-items-center tw-justify-between tw-p-5 tw-bg-white tw-rounded tw-shadow-sm">
        <div>
            <div class="tw-text-sm tw-text-gray-400">{{props.title}}</div>
            <div class="tw-flex tw-items-center tw-pt-1">
                <div class="tw-text-xl tw-font-medium tw-text-indigo-400">{{props.value}}</div>
            </div>
        </div>
        <div class="tw-text-gray-300">
            <slot name="icon"></slot>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    title: {
        type: String,
        required: true
    },
    icon: {
        type: String,
        required: true
    },
    type: {
        type: String,
        default: 'button'
    },
    loading: {
        type: Boolean,
        default: false
    }
})
</script>

<template>
    <button
        :type="props.type"
        class="tw-inline-flex tw-items-center tw-rounded-md tw-border tw-border-transparent tw-bg-gray-900 tw-px-3 tw-py-2 tw-text-sm tw-font-medium tw-leading-4 tw-text-white tw-shadow-sm hover:tw-bg-gray-800 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-gray-500 focus:tw-ring-offset-2"
        :disabled="props.loading"
    >
        <i v-if="!props.loading" :class='`bx ${props.icon}`' class="tw-text-sm"></i>
        <i v-else class='bx bx-loader tw-animate-spin' ></i>
        <span class="tw-ml-2">{{props.title}}</span>
    </button>
</template>

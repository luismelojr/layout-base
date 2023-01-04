<script setup>
const props = defineProps({
    title: {
        type: String,
        required: true
    },
    href: {
        type: String,
        required: false
    },
    back: {
        type: Boolean,
        required: false
    }
})
</script>

<template>
    <Link :href="props.href" class="tw-inline-flex tw-items-center tw-rounded-md tw-border tw-border-transparent tw-bg-gray-900 tw-px-3 tw-py-2 tw-text-sm tw-font-medium tw-leading-4 tw-text-white tw-shadow-sm hover:tw-bg-gray-800 focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-gray-500 focus:tw-ring-offset-2">
        <i v-if="!props.back" class='bx bx-plus -tw-ml-0.5 tw-mr-2 tw-h-4 tw-w-4' ></i>
        <i v-else class='bx bx-left-arrow-alt -tw-ml-0.5 tw-mr-2 tw-h-4 tw-w-4' ></i>
        {{props.title}}
    </Link>
</template>

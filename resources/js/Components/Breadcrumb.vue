<script setup>
const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
})
</script>

<template>
    <ul class="tw-flex tw-items-center tw-gap-1">
        <li v-for="(item, index) in items" :key="item.name" class="tw-flex tw-items-center tw-gap-1">
            <Link :href="item.href" class="tw-text-sm tw-font-medium hover:tw-text-indigo-500" :class="{'tw-text-indigo-500': item.current, 'tw-text-gray-400': !item.current}">
                {{ item.name }}
            </Link>
            <span v-if="index < items.length - 1" class="tw-text-gray-400 tw-text-sm tw-font-medium">
                <i-heroicons-chevron-right-20-solid />
            </span>
        </li>
    </ul>
</template>

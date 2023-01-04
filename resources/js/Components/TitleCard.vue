<script setup>
const props = defineProps({
    title: {
        type: String,
        required: true
    },
    subtitle: {
        type: String,
        required: false
    },
    actions: {
        type: Object,
        required: false
    }
})
</script>

<template>
    <div class="tw-border-b tw-border-gray-200">
        <div class="-tw-ml-4 -tw-mt-4 tw-flex tw-flex-wrap tw-items-center tw-justify-between sm:tw-flex-nowrap">
            <div class="tw-ml-4 tw-mt-4">
                <h3 class="tw-text-lg tw-font-medium tw-leading-6 tw-text-gray-900">{{props.title}}</h3>
                <p v-if="!!props.subtitle" class="tw-mt-1 tw-text-sm tw-text-gray-500">{{props.subtitle}}</p>
            </div>
            <div v-if="!!props.actions" class="tw-ml-4 tw-mt-2 tw-mb-2 tw-flex-shrink-0 md:tw-mt-4 md:tw-mb-0">
                <nav-link v-can="props.actions.can" :title="props.actions.title" :href="props.actions.href" :back="props.actions.isback"/>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    href: {
        type: String,
        required: true,
    },
})
</script>

<template>
    <Link :href="props.href" class="tw-text-primary tw-text-[0.875rem] tw-font-titillium tw-font-bold hover:tw-underline">
        <slot />
    </Link>
</template>

<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="block font-bold text-sm text-[#1E293B] font-titillium">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>

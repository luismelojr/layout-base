<script setup>
defineProps({
    heads: {
        type: Array,
        required: true
    }
})
</script>

<template>
    <div class="tw-flex tw-flex-col">
        <div class="tw--my-2 tw--mx-4 tw-overflow-x-auto sm:tw--mx-6 lg:tw--mx-8">
            <div class="tw-inline-block tw-min-w-full tw-py-2 tw-align-middle md:tw-px-6 lg:tw-px-8">
                <div class="tw-overflow-hidden tw-ring-opacity-5">
                    <table class="tw-min-w-full tw-divide-y tw-divide-gray-300">
                        <thead class="tw-bg-gray-50">
                        <tr>
                            <th v-for="item in heads" :key="item" scope="col" class="tw-py-3.5 tw-pl-4 tw-pr-3 tw-text-left tw-text-sm tw-font-semibold tw-text-gray-900 sm:tw-pl-6">{{item}}</th>
                            <th scope="col" class="tw-relative tw-py-3.5 tw-pl-3 tw-pr-4 sm:tw-pr-6">
                                <span class="tw-sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="tw-divide-y tw-divide-gray-200 tw-bg-white">
                        <slot />
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

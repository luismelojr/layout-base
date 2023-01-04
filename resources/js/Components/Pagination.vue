<script setup>
import {computed} from "vue";
import {Link} from "@inertiajs/inertia-vue3";
const props = defineProps({
    data: {
        type: Object,
        required: true
    }
})
const cleanLinks = computed(() => {
    const clean = [...props.data.links]
    clean.shift()
    clean.pop()
    return clean;
})
</script>

<template>
    <div class="tw-py-4 tw-flex tw-items-center tw-justify-between tw-border-t tw-border-gray-200">
        <div class="tw-flex-1 tw-flex tw-justify-between sm:tw-hidden">
            <Link v-if="data.prev_page_url" :href="data.prev_page_url"
                  class="tw-relative tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-text-sm tw-font-medium tw-rounded-md tw-text-gray-700 tw-bg-white hover:tw-bg-gray-50">
                Anterior
            </Link>
            <Link v-if="data.next_page_url" :href="data.next_page_url"
                  class="tw-relative tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-border tw-border-gray-300 tw-text-sm tw-font-medium tw-rounded-md tw-text-gray-700 tw-bg-white hover:tw-bg-gray-50">
                Proximo
            </Link>
        </div>
        <div class="tw-hidden sm:tw-flex-1 sm:tw-flex sm:tw-items-center sm:tw-justify-between">
            <div>
                <p class="tw-text-sm tw-text-gray-700">
                    Listando
                    <span class="tw-font-medium">{{ data.current_page }}</span>
                    a
                    <span class="tw-font-medium">{{ data.to }}</span>
                    de
                    <span class="tw-font-medium">{{ data.total }}</span>
                    resultados
                </p>
            </div>
            <div v-if="cleanLinks.length > 1">
                <nav class="tw-relative tw-z-0 tw-inline-flex tw-rounded-md tw-shadow-sm tw--space-x-px" aria-label="Pagination">
                    <Link preserve-scroll v-if="data.prev_page_url" :href="data.prev_page_url"
                          class="tw-relative tw-inline-flex tw-items-center tw-px-2 tw-py-2 tw-rounded-l-md tw-border tw-border-gray-300 tw-bg-white tw-text-sm tw-font-medium tw-text-gray-500 hover:tw-bg-gray-50">
                        <span class="tw-sr-only">Previous</span>
                        <!-- Heroicon name: solid/chevron-left -->
                        <svg class="tw-h-5 tw-w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </Link>
                    <button v-else class="tw-opacity-50 tw-cursor-not-allowed tw-relative tw-inline-flex tw-items-center tw-px-2 tw-py-2 tw-rounded-l-md tw-border tw-border-gray-300 tw-bg-white tw-text-sm tw-font-medium tw-text-gray-500 hover:tw-bg-gray-50" disabled>
                        <span class="tw-sr-only">Previous</span>
                        <!-- Heroicon name: solid/chevron-left -->
                        <svg class="tw-h-5 tw-w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                    <Link v-for="link in cleanLinks" :href="link.url" aria-current="page" :key="link.label"
                          preserve-scroll
                          class="tw-bg-white tw-border-gray-300 tw-text-gray-500 hover:tw-bg-gray-50 tw-relative tw-inline-flex tw-items-center tw-px-4 tw-py-2 tw-border tw-text-sm tw-font-medium"
                          :class="{'tw-z-10 tw-bg-indigo-50 tw-border-indigo-500 tw-text-indigo-600': link.active}"
                    >
                        {{ link.label }}
                    </Link>
                    <Link preserve-scroll v-if="data.next_page_url" :href="data.next_page_url"
                          class="tw-relative tw-inline-flex tw-items-center tw-px-2 tw-py-2 tw-rounded-r-md tw-border tw-border-gray-300 tw-bg-white tw-text-sm tw-font-medium tw-text-gray-500 hover:tw-bg-gray-50">
                        <span class="tw-sr-only">Next</span>
                        <!-- Heroicon name: solid/chevron-right -->
                        <svg class="tw-h-5 tw-w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </Link>
                    <button v-else class="tw-opacity-50 tw-cursor-not-allowed tw-relative tw-inline-flex tw-items-center tw-px-2 tw-py-2 tw-rounded-l-md tw-border tw-border-gray-300 tw-bg-white tw-text-sm tw-font-medium tw-text-gray-500 hover:tw-bg-gray-50" disabled>
                        <span class="tw-sr-only">Previous</span>
                        <!-- Heroicon name: solid/chevron-left -->
                        <svg class="tw-h-5 tw-w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             aria-hidden="true">
                            <path fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>
                </nav>
            </div>
        </div>
    </div>
</template>

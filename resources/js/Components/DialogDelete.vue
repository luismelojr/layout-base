<script setup>
const props = defineProps({
    title: String,
    remove: Function
})
</script>

<template>
    <q-card class="tw-relative tw-bg-white tw-rounded-lg tw-px-4 tw-pt-5 tw-pb-4 tw-text-left tw-overflow-hidden tw-shadow-xl tw-transform tw-transition-all sm:tw-my-8 sm:tw-max-w-lg sm:tw-w-full sm:tw-p-6">
        <div class="sm:tw-flex sm:tw-items-start">
            <div class="tw-mx-auto tw-flex-shrink-0 tw-flex tw-items-center tw-justify-center tw-h-12 tw-w-12 tw-rounded-full tw-bg-red-100 sm:tw-mx-0 sm:tw-h-10 sm:tw-w-10">
                <svg class="tw-h-6 tw-w-6 tw-text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div class="tw-mt-3 tw-text-center sm:tw-mt-0 sm:tw-ml-4 sm:tw-text-left">
                <h3 class="tw-text-lg tw-leading-6 tw-font-medium tw-text-gray-900">{{title}}</h3>
                <div class="tw-mt-2">
                    <p class="tw-text-sm tw-text-gray-500">Ao excluir não sera possivel recuperar o dado, exclua com cuidado!</p>
                </div>
            </div>
        </div>

        <q-card-actions align="right">
            <q-btn flat no-caps label="Cancelar" color="dark" v-close-popup />
            <button type="button"
                    @click="remove"
                    class="tw-w-full tw-inline-flex tw-justify-center tw-rounded
                                tw-border tw-border-transparent tw-shadow-sm tw-px-4 tw-py-2 tw-bg-red-600
                                tw-text-base tw-font-medium tw-text-white hover:tw-bg-red-700 focus:tw-outline-none
                                focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-red-500 sm:tw-ml-3 sm:tw-w-auto
                                sm:tw-text-sm"
                    v-close-popup
            >
                Excluir
            </button>
        </q-card-actions>
    </q-card>
</template>

<script setup>
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="tw-flex tw-items-center tw-justify-between">
            <h4 class="tw-text-gray-600 tw-text-2xl tw-font-bold">Dashboard</h4>
        </div>
        <div class="tw-mt-8">
            <div class="tw-grid tw-grid-cols-1 tw-gap-2 md:tw-grid-cols-2 lg:tw-grid-cols-4">
                <stat title="Users" value="1">
                    <template #icon>
                        <i-heroicons-user class="tw-text-2xl" />
                    </template>
                </stat>
                <stat title="Users" value="1">
                    <template #icon>
                        <i-heroicons-user class="tw-text-2xl" />
                    </template>
                </stat>
                <stat title="Users" value="1">
                    <template #icon>
                        <i-heroicons-user class="tw-text-2xl" />
                    </template>
                </stat>
                <stat title="Users" value="1">
                    <template #icon>
                        <i-heroicons-user class="tw-text-2xl" />
                    </template>
                </stat>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import {useForm} from "@inertiajs/inertia-vue3";

const itemsBread = [
    {
        name: 'Dashboard',
        href: route('admin.dashboard'),
        current: false
    },
    {
        name: 'Grupo de permissões',
        href: route('admin.settings.roles.index'),
        current: false
    },
    {
        name: 'Cadastrar',
        href: route('admin.settings.roles.create'),
        current: true
    }
]
const actionsTitle = {
    title: 'Voltar',
    href: route('admin.settings.roles.index'),
    isback: true,
    can: 'read-roles'
}
const props = defineProps({
    permissions: Object | Array,
})
const form = useForm({
    name: '',
    description: '',
    permissions: []
})

function checkAll(items) {
    const formPermissions = form.permissions
    if (formPermissions.length === 0) {
        form.permissions = items.map(item => item.id)
        return;
    }
    if (items.map(item => item.id).every(item => formPermissions.includes(item))) {
        form.permissions = formPermissions.filter(item => !items.map(item => item.id).includes(item))
        return;
    }

    form.permissions = [...formPermissions, ...items.map(item => item.id)]
}

</script>
<template>
    <AuthenticatedLayout>
        <div class="tw-flex tw-flex-col tw-gap-4 md:tw-items-center md:tw-justify-between md:tw-gap-0 md:tw-flex-row">
            <h4 class="tw-text-gray-600 tw-text-2xl tw-font-bold">Cadastrar grupo de permissões</h4>
            <breadcrumb :items="itemsBread"/>
        </div>
        <card class="tw-mt-4 md:tw-mt-8">
            <title-card title="Cadastrar grupos" subtitle="Use os campos abaixos para cadastrar grupos." :actions="actionsTitle"/>
            <form class="tw-mt-4" @submit.prevent="form.post(route('admin.settings.roles.store'))">
                <div class="tw-flex tw-gap-4 tw-flex-col md:tw-flex-row">
                    <div class="tw-w-full">
                        <label for="name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">Nome</label>
                        <q-input id="name" class="tw-mt-1" dense outlined v-model="form.name" :error="!!form.errors.name" :error-message="form.errors.name"/>
                    </div>
                    <div class="tw-w-full">
                        <label for="description" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">Descrição</label>
                        <q-input id="description" class="tw-mt-1" dense outlined v-model="form.description"/>
                    </div>
                </div>
                <div class="tw-mt-8 tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid md:tw-grid-cols-3 md:tw-gap-6">
                    <div v-for="(item, key) in permissions" :key="item.id">
                        <div class="tw-w-full tw-bg-gray-300 tw-py-2 tw-px-4 tw-capitalize tw-text-[18px] tw-text-gray-700 tw-flex tw-justify-between tw-items-center">
                            {{key}}
                            <button type="button" class="tw-text-sm tw-text-indigo-500" @click="checkAll(item)">Marca todos</button>
                        </div>
                        <div class="tw-w-full tw-py-2 tw-capitalize tw-text-md tw-text-gray-700 tw-grid tw-grid-cols-2 tw-gap-2">
                            <div v-for="permission in item" :key="permission.id" class="tw-flex tw-items-center tw-gap-2 tw-text-[16px]">
                                <input type="checkbox" :id="permission.id" :value="permission.id" v-model="form.permissions" class="tw-h-4 tw-w-4">
                                <label :for="permission.id">{{permission.name.replace('-', ' ')}}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tw-mt-4 tw-flex tw-justify-end">
                    <loading-button title="Cadastrar" icon="bx-save" type="submit" :loading="form.processing"/>
                </div>
            </form>
        </card>
    </AuthenticatedLayout>
</template>

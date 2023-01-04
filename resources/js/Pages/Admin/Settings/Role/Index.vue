<script setup>
import {Inertia} from "@inertiajs/inertia";

const itemsBread = [
    {
        name: 'Dashboard',
        href: route('admin.dashboard'),
        current: false
    },
    {
        name: 'Grupo de permissões',
        href: route('admin.settings.roles.index'),
        current: true
    }
]
const actionsTitle = {
    title: 'Cadastrar grupo',
    href: route('admin.settings.roles.create'),
    isback: false,
    can: 'create-roles'
}
const canRole = ['update-roles', 'delete-roles']
const remove = ref(false)
const roleId = ref(null)
const props = defineProps({
    roles: Object | Array,
    filters: Array | Object
})
const params = reactive({
    name: props.filters.name,
})
const loading = ref(false)

function handleFilter() {
    Inertia.get(route('admin.settings.roles.index'), params, {
        replace: true,
        preserveState: true,
        preserveScroll: true,
        onStart: () => {
            loading.value = true
        },
        onFinish: () => {
            loading.value = false
        }
    })
}

const isFilter = computed(() => {
    return !!params.name
})

function handleClear() {
    params.name = ''
    handleFilter()
}

function preventDelete(id) {
    remove.value = true
    roleId.value = id
}

function handleRemove() {
    Inertia.delete(route('admin.settings.roles.destroy', roleId.value), {
        preserveState: true,
        preserveScroll: true,
    })
}

function handleEdit(id) {
    Inertia.get(route('admin.settings.roles.edit', id))
}
</script>
<template>
    <AuthenticatedLayout>
        <div class="tw-flex tw-flex-col tw-gap-4 md:tw-items-center md:tw-justify-between md:tw-gap-0 md:tw-flex-row">
            <h4 class="tw-text-gray-600 tw-text-2xl tw-font-bold">Grupo de permissões</h4>
            <breadcrumb :items="itemsBread"/>
        </div>
        <card class="tw-mt-4 md:tw-mt-8">
            <title-card title="Filtrar grupos de permissões" subtitle="Use o campo abaixo para pesquisar por algum grupo expecifico." :actions="actionsTitle"/>
            <form class="tw-mt-4">
                <div class="tw-flex tw-gap-4">
                    <div class="tw-w-full tw-md:w-1/2">
                        <label for="name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">Nome</label>
                        <q-input id="name" class="tw-mt-1" dense outlined v-model="params.name"/>
                    </div>
                </div>
                <div class="tw-mt-4 tw-flex tw-justify-end tw-items-center">
                    <q-btn class="tw-mr-2" :loading="loading" v-if="isFilter" flat @click="handleClear" no-caps>Resetar filtro</q-btn>
                    <loading-button @click="handleFilter" title="Pesquisar" icon="bx-search" :loading="loading"/>
                </div>
            </form>
        </card>
        <card class="tw-mt-4">
            <div v-if="roles.data.length > 0">
                <Table :heads="['Nome', 'Descrição']">
                    <tr v-for="item in roles.data" :key="item.id">
                        <td  class="tw-whitespace-nowrap tw-py-4 tw-pl-4 tw-pr-3 tw-text-sm tw-font-medium tw-text-gray-900 sm:tw-pl-6">{{item.name}}</td>
                        <td  class="tw-whitespace-nowrap tw-py-4 tw-pl-4 tw-pr-3 tw-text-sm tw-font-medium tw-text-gray-900 sm:tw-pl-6">{{item.description ? item.description : 'Nenhuma descrição cadastrada'}}</td>
                        <td class="tw-relative tw-whitespace-nowrap tw-py-4 tw-pl-3 tw-pr-4 tw-text-right tw-text-sm tw-font-medium sm:tw-pr-6">
                            <q-btn flat icon="more_vert" color="grey-7" v-can="canRole">
                                <q-menu>
                                    <q-list style="min-width: 100px">
                                        <q-item clickable v-close-popup v-can="'update-roles'" @click="() => handleEdit(item.id)">
                                            <q-item-section>
                                                <Link class="tw-text-gray-500 hover:tw-text-gray-500 tw-flex tw-items-center tw-gap-2">
                                                    <i-heroicons-cog-6-tooth />
                                                    Editar
                                                </Link>
                                            </q-item-section>
                                        </q-item>
                                        <q-item clickable v-close-popup @click="() => preventDelete(item.id)" v-can="'delete-roles'">
                                            <q-item-section>
                                                <button class="tw-text-gray-500 hover:tw-text-gray-500 tw-flex tw-items-center tw-gap-2">
                                                    <i-heroicons-trash />
                                                    Excluir
                                                </button>
                                            </q-item-section>
                                        </q-item>
                                    </q-list>
                                </q-menu>
                            </q-btn>
                        </td>
                    </tr>
                </Table>
                <Pagination :data="roles"/>
            </div>
            <div v-else>
                <div class="tw-text-center">
                    <i-bi-key class="tw-mx-auto tw-h-12 tw-w-12 tw-text-gray-400"/>
                    <h3 class="tw-mt-2 tw-text-sm tw-font-medium tw-text-gray-500">Nenhum cargo cadastrado</h3>
                </div>
            </div>
        </card>
        <q-dialog v-model="remove" persistent>
            <DialogDelete title="Excluir cargo" :remove="handleRemove"/>
        </q-dialog>
    </AuthenticatedLayout>
</template>

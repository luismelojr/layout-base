<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import {Inertia} from '@inertiajs/inertia';
const itemsBread = [
    {
        name: 'Dashboard',
        href: route('admin.dashboard'),
        current: false
    },
    {
        name: 'Users',
        href: route('admin.users.index'),
        current: true
    }
]

const actionsTitle = {
    title: 'Cadastrar usuários',
    href: route('admin.users.create'),
    isback: false,
    can: 'create-users'
}

const props = defineProps({
    users: Object | Array,
    filters: Array | Object
})

const params = reactive({
    name: props.filters.name,
    email: props.filters.email,
    is_active: props.filters.is_active,
})

const loading = ref(false)

function handleFilter() {
    Inertia.get(route('admin.users.index'), params, {
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
    return params.name || params.email || params.is_active
})

function handleClear() {
    params.name = ''
    params.email = ''
    params.is_active = null
    handleFilter()
}

const remove = ref(false)
const statusModal = ref(false)
const userId = ref(null)

function handleRemove() {
    Inertia.delete(route('admin.users.destroy', {'user': userId.value}))
}

function preventDelete(id) {
    userId.value = id
    remove.value = true
}

function preventStatus(user) {
    userId.value = user
    statusModal.value = true
}

function handleEdit(id) {
    Inertia.get(route('admin.users.edit', {'user': id}))
}

function handleStatus() {
    Inertia.put(route('admin.users.status', {'user': userId.value}))
}

const canUser = ['update-users', 'delete-users']

const optionsStatus = [
    {
      value: '',
      label: 'Todos'
    },
    {
        value: '1',
        label: 'Ativo'
    },
    {
        value: '0',
        label: 'Inativo'
    }
]
</script>

<template>
    <Head title="Users" />
    <AuthenticatedLayout>
        <div class="tw-flex tw-flex-col tw-gap-4 md:tw-items-center md:tw-justify-between md:tw-gap-0 md:tw-flex-row">
            <h4 class="tw-text-gray-600 tw-text-2xl tw-font-bold">Usuários</h4>
            <breadcrumb :items="itemsBread"/>
        </div>
        <card class="tw-mt-4 md:tw-mt-8">
            <title-card title="Filtrar usuários" subtitle="Use os campos abaixos para filtrar usuários." :actions="actionsTitle"/>
            <form class="tw-mt-4">
                <div class="tw-flex tw-gap-4 tw-flex-col md:tw-flex-row">
                    <div class="tw-w-full md:tw-1/2">
                        <label for="name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">Nome</label>
                        <q-input v-model="params.name" id="name" class="tw-mt-1" dense outlined/>
                    </div>
                    <div class="tw-w-full md:tw-1/2">
                        <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">E-mail</label>
                        <q-input v-model="params.email" id="email" class="tw-mt-1" dense outlined/>
                    </div>
                    <div class="tw-w-full md:tw-1/2">
                        <label for="name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">Status</label>
                        <q-select v-model="params.is_active" emit-value map-options id="status" class="tw-mt-1" dense outlined :options="optionsStatus"/>
                    </div>
                </div>
                <div class="tw-mt-4 tw-flex tw-justify-end tw-items-center">
                    <q-btn class="tw-mr-2" :loading="loading" v-if="isFilter" flat @click="handleClear" no-caps>Resetar filtro</q-btn>
                    <loading-button @click="handleFilter" title="Pesquisar" icon="bx-search" :loading="loading"/>
                </div>
            </form>
        </card>
        <card class="tw-mt-4">
            <div v-if="props.users.data.length > 0">
                <Table :heads="['Nome', 'E-mail', 'Role', 'Status']">
                    <tr v-for="item in props.users.data" :key="item.id">
                        <td  class="tw-whitespace-nowrap tw-py-4 tw-pl-4 tw-pr-3 tw-text-sm tw-font-medium tw-text-gray-900 sm:tw-pl-6">{{item.name}}</td>
                        <td  class="tw-whitespace-nowrap tw-py-4 tw-pl-4 tw-pr-3 tw-text-sm tw-font-medium tw-text-gray-900 sm:tw-pl-6">{{item.email}}</td>
                        <td  class="tw-whitespace-nowrap tw-py-4 tw-pl-4 tw-pr-3 tw-text-sm tw-font-medium tw-text-gray-900 sm:tw-pl-6">
                            <span class="tw-inline-flex tw-items-center tw-px-2.5 tw-py-0.5 tw-rounded-full tw-text-xs tw-font-medium tw-bg-indigo-100 tw-text-indigo-800 tw-capitalize">{{item.roles[0].name}}</span>
                        </td>
                        <td  class="tw-whitespace-nowrap tw-py-4 tw-pl-4 tw-pr-3 tw-text-sm tw-font-medium tw-text-gray-900 sm:tw-pl-6">
                            <span class="tw-inline-flex tw-items-center tw-px-2.5 tw-py-0.5 tw-rounded-full tw-text-xs tw-font-medium tw-capitalize"
                                  :class="{'tw-bg-green-100 tw-text-green-800': item.is_active, 'tw-bg-red-100 tw-text-red-800': !item.is_active}">{{item.is_active ? 'Ativo' : 'Inativo'}}</span>
                        </td>
                        <td class="tw-relative tw-whitespace-nowrap tw-py-4 tw-pl-3 tw-pr-4 tw-text-right tw-text-sm tw-font-medium sm:tw-pr-6">
                            <q-btn flat icon="more_vert" color="grey-7" v-can="canUser">
                                <q-menu>
                                    <q-list style="min-width: 100px">
                                        <q-item clickable v-can="'update-users'" @click="() => handleEdit(item.id)">
                                            <q-item-section>
                                                <Link  class="tw-text-gray-500 hover:tw-text-gray-500 tw-flex tw-items-center tw-gap-2">
                                                    <i-heroicons-cog-6-tooth />
                                                    Editar
                                                </Link>
                                            </q-item-section>
                                        </q-item>
                                        <q-item clickable @click="() => preventStatus(item)" v-close-popup v-if="!item.is_active" v-can="'status-users'">
                                            <q-item-section>
                                                <button class="tw-text-gray-500 hover:tw-text-gray-500 tw-flex tw-items-center tw-gap-2">
                                                    <i-heroicons-check-circle />
                                                    Ativar
                                                </button>
                                            </q-item-section>
                                        </q-item>
                                        <q-item clickable @click="() => preventStatus(item)" v-close-popup v-else v-can="'status-users'">
                                            <q-item-section>
                                                <button class="tw-text-gray-500 hover:tw-text-gray-500 tw-flex tw-items-center tw-gap-2">
                                                    <i-heroicons-x-circle />
                                                    Desativar
                                                </button>
                                            </q-item-section>
                                        </q-item>
                                        <q-item clickable @click="() => preventDelete(item.id)" v-close-popup v-can="'delete-users'">
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
                <Pagination :data="users"/>
            </div>
            <div v-else>
                <div class="tw-text-center">
                    <i-bi-person class="tw-mx-auto tw-h-12 tw-w-12 tw-text-gray-400"/>
                    <h3 class="tw-mt-2 tw-text-sm tw-font-medium tw-text-gray-500">Nenhum usuário cadastrado</h3>
                </div>
            </div>
        </card>
        <q-dialog v-model="remove" persistent>
            <DialogDelete title="Excluir Usuário" :remove="handleRemove"/>
        </q-dialog>
        <q-dialog v-model="statusModal" persistent>
            <DialogStatus
                :title="userId.is_active ? 'Desativar usuário': 'Ativar usuário'"
                :message="userId.is_active? 'Deseja desativar o usuário?': 'Deseja ativar o usuário?'"
                :mode="!!userId.is_active"
                :remove="handleStatus"/>
        </q-dialog>
    </AuthenticatedLayout>
</template>

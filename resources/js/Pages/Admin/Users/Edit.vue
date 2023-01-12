<script setup>

const props = defineProps({
    user: Object | Array,
    roles: Object | Array,
})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    role: props.user.roles[0].id,
})

const itemsBread = [
    {
        name: 'Dashboard',
        href: route('admin.dashboard'),
        current: false
    },
    {
        name: 'Users',
        href: route('admin.users.index'),
        current: false
    },
    {
        name: 'Edit user',
        href: route('admin.users.edit', props.user.id),
        current: true
    }
]
const actionsTitle = {
    title: 'Voltar',
    href: route('admin.users.index'),
    isback: true
}

function handleUpdate() {
    form.put(route('admin.users.update', {user: props.user.id}))
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="tw-flex tw-items-center tw-justify-between">
            <h4 class="tw-text-gray-600 tw-text-2xl tw-font-bold">Usuários</h4>
            <breadcrumb :items="itemsBread"/>
        </div>
        <card class="tw-mt-8">
            <title-card title="Editar usuário" subtitle="Use os campos abaixos para editar usuário." :actions="actionsTitle"/>
            <form class="tw-mt-4" @submit.prevent="handleUpdate">
                <div>
                    <label for="name" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">Nome</label>
                    <q-input id="name" class="tw-mt-1" dense outlined v-model="form.name" :error="!!form.errors.name" :error-message="form.errors.name"/>
                </div>
                <div class="tw-mt-2">
                    <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">E-mail</label>
                    <q-input id="email" class="tw-mt-1" dense outlined v-model="form.email" :error="!!form.errors.email" :error-message="form.errors.email"/>
                </div>
                <div class="tw-mt-2">
                    <label for="role" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">Cargo</label>
                    <q-select id="role" class="tw-mt-1" dense outlined v-model="form.role" :options="props.roles" option-value="id" option-label="name" emit-value map-options :error="!!form.errors.role" :error-message="form.errors.role"/>
                </div>
                <div class="tw-mt-2 tw-flex tw-justify-end">
                    <loading-button title="Atualizar" icon="bx-save" type="submit" :loading="form.processing"/>
                </div>
            </form>
        </card>
    </AuthenticatedLayout>
</template>

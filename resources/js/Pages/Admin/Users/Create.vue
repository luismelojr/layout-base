<script setup>
const props = defineProps({
    roles: Array | Object,
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
        name: 'Create users',
        href: route('admin.users.create'),
        current: true
    }
]
const actionsTitle = {
    title: 'Voltar',
    href: route('admin.users.index'),
    isback: true
}

const form = useForm({
    name: '',
    email: '',
    role: '',
    password: '',
    password_confirmation: ''
})

const isPwd = ref(true)
const isPwdC = ref(true)
</script>

<template>
    <Head title="Users" />
    <AuthenticatedLayout>
        <div class="tw-flex tw-items-center tw-justify-between">
            <h4 class="tw-text-gray-600 tw-text-2xl tw-font-bold">Usuários</h4>
            <breadcrumb :items="itemsBread"/>
        </div>
        <card class="tw-mt-8">
            <title-card title="Cadastrar usuários" subtitle="Use os campos abaixos para cadastrar usuários." :actions="actionsTitle"/>
            <form class="tw-mt-4" @submit.prevent="form.post(route('admin.users.store'))">
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
                <div class="tw-mt-2">
                    <label for="password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">Senha</label>
                    <q-input class="tw-mt-1" v-model="form.password" outlined dense :type="isPwd ? 'password' : 'text'" :error="!!form.errors.password" :error-message="form.errors.password">
                        <template v-slot:append>
                            <q-icon
                                :name="isPwd ? 'visibility': 'visibility_off'"
                                class="cursor-pointer"
                                @click="isPwd = !isPwd"
                            />
                        </template>
                    </q-input>
                </div>
                <div class="tw-mt-2">
                    <label for="password_confirmation" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">Confirma senha</label>
                    <q-input class="tw-mt-1" v-model="form.password_confirmation" outlined dense :type="isPwdC ? 'password' : 'text'" :error="!!form.errors.password_confirmation" :error-message="form.errors.password_confirmation">
                        <template v-slot:append>
                            <q-icon
                                :name="isPwdC ? 'visibility': 'visibility_off'"
                                class="cursor-pointer"
                                @click="isPwdC = !isPwdC"
                            />
                        </template>
                    </q-input>
                </div>
                <div class="tw-mt-2 tw-flex tw-justify-end">
                    <loading-button title="Cadastrar" icon="bx-save" type="submit" :loading="form.processing"/>
                </div>
            </form>
        </card>
    </AuthenticatedLayout>
</template>

<script setup>
import {Head, useForm} from '@inertiajs/inertia-vue3';
const form = useForm({
    email: '',
    password: '',
    remember: false,
});
const isPwd = ref(true)
</script>

<template>
    <GuestLayout>
        <Head title="Melo Dev - Log in" />

        <div class="tw-mt-4">
            <div class="tw-text-center">
                <h3 class="tw-text-xl tw-text-gray-400 tw-font-medium">Log in</h3>
                <p class="tw-text-gray-400 tw-text-[0.8rem]">Entre com seu email e <br> senha para acessar o painel</p>
            </div>

            <form>
                <div>
                    <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">Email</label>
                    <q-input v-model="form.email" id="email" class="tw-mt-1" dense outlined :error="!!form.errors.email" :error-message="form.errors.email"/>
                </div>
                <div class="tw-mt-2">
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <label for="password" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">Senha</label>
                        <Link :href="route('password.request')" class="tw-text-[0.7rem] tw-text-gray-400">Esqueceu sua senha?</Link>
                    </div>
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
                <div>
                    <q-checkbox class="-tw-ml-2 tw-text-gray-400" v-model="form.remember" label="Lembrar-me" />
                </div>
                <div class="tw-w-full tw-mt-4">
                    <q-btn
                        class="full-width"
                        style="background: #6366F1; color: white"
                        :loading="form.processing"
                        label="Acessar"
                        no-caps
                        @click="form.post(route('login'))"
                    />
                </div>
            </form>
        </div>
    </GuestLayout>
</template>

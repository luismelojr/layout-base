<script setup>
const props = defineProps({
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    password: '',
    password_confirmation: '',
    token: props.token
});

const isPwd = ref(true)
const isPwdC = ref(true)

</script>
<template>
    <GuestLayout :is-login="false">
        <Head title="Melo Dev - Resetar senha" />
        <div class="tw-mt-4">
            <div class="tw-text-center">
                <h3 class="tw-text-xl tw-text-gray-400 tw-font-medium">Resetar senha</h3>
                <p class="tw-text-gray-400 tw-text-[0.8rem]">Cadastre a sua nova senha e confirme a mesma!</p>
            </div>

            <form @submit.prevent="form.post(route('password.reset.store'))">
                <div>
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
                <div class="tw-w-full tw-mt-4">
                    <q-btn
                        class="full-width"
                        style="background: #6366F1; color: white"
                        :loading="form.processing"
                        label="Enviar"
                        type="submit"
                        no-caps
                    />
                </div>
            </form>
        </div>
    </GuestLayout>
</template>

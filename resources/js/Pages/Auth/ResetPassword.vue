<script setup>
import TextLabel from "@/Components/Inputs/TextLabel.vue";
import AnchorLink from "@/Components/Navigations/AnchorLink.vue";

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

function submit() {
    form.post(route('password.reset.store'))
}

</script>
<template>
    <GuestLayout :is-login="false">
        <Head title="Melo Dev - Resetar senha" />

        <div>
            <h1 class="tw-text-4xl tw-font-bold">Redefina sua senha</h1>
            <p class="tw-mt-[1rem] tw-text-[1rem] tw-text-gray-600">Redefina sua senha e recupere o acesso à sua conta agora mesmo.</p>
        </div>
        <form @submit.prevent="submit" class="tw-mt-[2.5rem]">
            <div class="tw-mt-1">
                <TextLabel value="Senha"/>
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
            <div class="tw-mt-1">
                <TextLabel value="Confirme a senha"/>
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
            <q-btn
                class="full-width tw-mt-4"
                type="submit"
                color="primary"
                :loading="form.processing"
                label="Enviar"
                no-caps
            />
        </form>
        <div class="tw-mt-8">
            <p class="tw-text-gray-800 tw-text-[0.875rem]">Senha redefinida com sucesso? <AnchorLink :href="route('login')">Login</AnchorLink></p>
        </div>
    </GuestLayout>
</template>

git<script setup>
import {Head, useForm} from '@inertiajs/inertia-vue3';
import TextLabel from "@/Components/Inputs/TextLabel.vue";
import AnchorLink from "@/Components/Navigations/AnchorLink.vue";
const form = useForm({
    email: '',
    password: '',
    remember: false,
});

function submit() {
    form.post(route('login'));
}

const isPwd = ref(true);
</script>

<template>
    <GuestLayout>
        <Head title="Melo Dev - Log in" />
        <div>
            <h1 class="tw-text-4xl tw-font-bold">Acesse a plataforma</h1>
            <p class="tw-mt-[1rem] tw-text-[1rem] tw-text-gray-600">Faça login ou registre-se para começar a construir seus projetos ainda hoje.</p>
        </div>

        <form @submit.prevent="submit" class="tw-mt-[2.5rem]">
            <div>
                <TextLabel value="E-mail"/>
                <q-input v-model="form.email" id="email" class="tw-mt-2 hover:border-primary" dense outlined :error="!!form.errors.email" :error-message="form.errors.email"/>
            </div>
            <div class="tw-mt-1">
                <div class="tw-flex tw-items-center tw-justify-between">
                    <TextLabel value="Senha"/>
                    <AnchorLink :href="route('password.request')">Esqueceu a senha?</AnchorLink>
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
            <q-btn
                class="full-width tw-mt-4"
                color="primary"
                :loading="form.processing"
                label="Entrar"
                no-caps
                @click="form.post(route('login'))"
            />
        </form>
    </GuestLayout>
</template>

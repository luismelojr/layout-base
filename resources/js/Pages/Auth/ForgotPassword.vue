<script setup>
import TextLabel from "@/Components/Inputs/TextLabel.vue";
import AnchorLink from "@/Components/Navigations/AnchorLink.vue";

const form = useForm({
    email: '',
});

function submit() {
    form.post(route('password.reset.send'), {
        onFinish: () => {
            form.email = '';
        }
    })
}

</script>
<template>
    <GuestLayout>
        <Head title="Melo Dev - Esqueci minha senha" />
        <div>
            <h1 class="tw-text-4xl tw-font-bold">Recupere sua senha</h1>
            <p class="tw-mt-[1rem] tw-text-[1rem] tw-text-gray-600">Recupere o acesso à sua conta em apenas alguns passos simples.</p>
        </div>

        <form @submit.prevent="submit" class="tw-mt-[2.5rem]">
            <div>
                <TextLabel value="E-mail"/>
                <q-input v-model="form.email" id="email" class="tw-mt-2 hover:border-primary" dense outlined :error="!!form.errors.email" :error-message="form.errors.email"/>
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
            <p class="tw-text-gray-800 tw-text-[0.875rem]">Já lembrou sua senha? <AnchorLink :href="route('login')">Login</AnchorLink></p>
        </div>
    </GuestLayout>
</template>

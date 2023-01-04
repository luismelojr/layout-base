<script setup>
const form = useForm({
    email: '',
});

function handleSubmit() {
    form.post(route('password.reset.send'))
    form.reset()
}

</script>
<template>
    <GuestLayout :is-login="false">
        <Head title="Melo Dev - Esqueci minha senha" />
        <div class="tw-mt-4">
            <div class="tw-text-center">
                <h3 class="tw-text-xl tw-text-gray-400 tw-font-medium">Recuperar senha</h3>
                <p class="tw-text-gray-400 tw-text-[0.8rem]">Entre com seu email<br> para receber as instruções para recuperar senha</p>
            </div>

            <form @submit.prevent="handleSubmit">
                <div>
                    <label for="email" class="tw-block tw-text-sm tw-font-medium tw-text-gray-400">Email</label>
                    <q-input v-model="form.email" id="email" class="tw-mt-1" dense outlined :error="!!form.errors.email" :error-message="form.errors.email"/>
                </div>
                <div class="tw-w-full tw-mt-4">
                    <q-btn
                        class="full-width"
                        style="background: #6366F1; color: white"
                        :loading="form.processing"
                        label="Enviar"
                        no-caps
                        type="submit"
                    />
                </div>
            </form>
        </div>
    </GuestLayout>
</template>

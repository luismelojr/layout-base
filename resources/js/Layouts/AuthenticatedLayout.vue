<script setup>
import { Modal } from 'momentum-modal'
import useUser from "@/Data/Hooks/useUser";
const user = useUser()
</script>

<template>
    <div class="tw-bg-light tw-min-h-screen">
        <header class="tw-bg-dark tw-w-full tw-h-[70px] tw-relative tw-flex tw-items-center">
            <div class="container tw-flex tw-justify-between tw-items-center">
                <Link :href="route('admin.dashboard')">
                    <ApplicationLogo class="tw-h-7 tw-w-7 tw-text-white"/>
                </Link>
                <div>
                    <button class="tw-absolute tw-top-0 tw-right-[10px] tw-h-full tw-px-4 tw-flex tw-items-center md:tw-right-[24px]">
                        <div class="tw-flex tw-gap-2 tw-items-center">
                            <q-avatar color="grey-8" text-color="grey-5" size="40px">{{user.name[0]}}</q-avatar>
                            <div class="tw-flex tw-flex-col tw-text-left">
                                <span class="tw-text-gray-300 tw-text-sm tw-font-sans">{{user.name}}</span>
                                <span class="tw-text-gray-300 tw-text-xs tw-font-sans">{{user.email}}</span>
                            </div>
                        </div>
                        <q-menu>
                            <span class="tw-text-[12px] tw-text-gray-400 tw-font-sans tw-font-bold tw-px-[20px] tw-block tw-py-[15px]">Bem vindo !</span>
                            <div class="tw-mt-0">
                                <Link class="tw-flex tw-items-center tw-text-[14.4px] tw-py-[7px] tw-px-[20px] tw-text-gray-400 tw-font-sans hover:tw-text-gray-700 hover:tw-bg-gray-100" :href="route('admin.profile.index')">
                                    <i-mdi-account-edit />
                                    <span class="tw-ml-2">Editar perfil</span>
                                </Link>
                                <Link class="tw-flex tw-w-full tw-items-center tw-text-[14.4px] tw-py-[7px] tw-px-[20px] tw-text-gray-400 tw-font-sans hover:tw-text-gray-700 hover:tw-bg-gray-100" :href="route('logout')" method="post" as="button">
                                    <i-mdi-logout />
                                    <span class="tw-ml-2">Sair</span>
                                </Link>
                            </div>
                        </q-menu>
                    </button>
                </div>
            </div>
        </header>
        <navigation />
        <main class="container tw-py-6">
            <slot/>
        </main>
        <Toasts />
        <Modal />
    </div>
</template>

<style>
</style>

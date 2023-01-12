<script setup>
import {Disclosure, DisclosureButton, Popover, PopoverButton, PopoverPanel} from '@headlessui/vue'
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
const mobileMenuOpen = ref(false)
const links = [
    {
        name: 'Dashboard',
        icon: 'bx bx-grid-alt',
        href: route('admin.dashboard'),
        routeActive: ['admin.dashboard'],
    },
    {
        name: 'Cadastros',
        icon: 'bx bx-grid-alt',
        routeActive: ['admin.users.*'],
        can:['read-users'],
        children: [
            {
                name: 'Usuários',
                href: route('admin.users.index'),
                can: 'read-users'
            },
        ]
    },
    {
        name: 'Configurações',
        icon: 'bx bx-cog',
        routeActive: ['admin.settings.*'],
        can:['read-roles'],
        children: [
            {
                name: 'Grupos de Permissões',
                href: route('admin.settings.roles.index'),
                can: 'read-roles'
            }
        ]
    },
]

function isActive(routeName) {
    const value = routeName.map((item) => {
        if (route().current(item)) {
            return true
        }
    })
    return value.includes(true)
}

function toggleMenu() {
    mobileMenuOpen.value = !mobileMenuOpen.value
}
</script>

<template>
<div class="tw-bg-white tw-w-full tw-h-[54px] tw-shadow-sm tw-relative tw-flex tw-items-start tw-text-inherit tw-flex-col md:tw-flex-row md:tw-items-center">
    <div class="container">
        <ul class="tw-w-full tw-items-center tw-gap-8 -tw-ml-1 tw-hidden md:tw-flex">
            <Popover class="tw-relative" v-for="link in links" :key="link.name" v-can="link.can" :class="{'tw-flex tw-items-center tw-gap-3': !!link.children}">
                <PopoverButton>
                    <div v-if="!!link.children" class="tw-text-[15px] tw-flex tw-items-center tw-gap-2 tw-cursor-pointer" :class="{'tw-text-indigo-500': isActive(link.routeActive), 'tw-text-gray-400': !isActive(link.routeActive)}">
                        <i :class="link.icon" class="tw-text-[15px]"></i>
                        <span>{{ link.name }}</span>
                        <i v-if="!!link.children" class='bx bx-chevron-down tw-text-[16px] tw-text-inherit'></i>
                    </div>
                    <Link v-else :href="link.href" class="tw-text-[15px] tw-flex tw-items-center tw-gap-2" :class="{'tw-text-indigo-500': isActive(link.routeActive), 'tw-text-gray-400': !isActive(link.routeActive)}">
                        <i :class="link.icon" class="tw-text-[15px]"></i>
                        <span>{{ link.name }}</span>
                        <i v-if="!!link.children" class='bx bx-chevron-down tw-text-[16px] tw-text-inherit'></i>
                    </Link>
                </PopoverButton>

                <PopoverPanel v-if="!!link.children" class="tw-absolute tw-z-10 tw-top-9 tw-bg-white tw-shadow-md tw-w-full tw-py-1">
                    <div class="tw-flex tw-flex-col">
                        <Link v-for="(item, index) in link.children" :key="index" :href="item.href" v-can="item.can" class="hover:tw-bg-gray-100 tw-w-full tw-py-2 tw-px-4 tw-text-gray-400">{{item.name}}</Link>
                    </div>
                </PopoverPanel>
            </Popover>
        </ul>
        <div class="tw-w-full md:tw-hidden tw-mt-4">
            <button class="tw-cursor-pointer" @click="toggleMenu">
                <i class='bx bx-menu tw-text-[24px]'></i>
            </button>
        </div>

        <q-layout v-if="mobileMenuOpen">
            <q-drawer v-model="mobileMenuOpen" side="left" :width="300" :content-css="{'min-height': '100vh'}" :overlay="true" :persistent="true">
                <q-scroll-area class="tw-h-full tw-flex tw-flex-col tw-justify-between">
                    <div class="tw-flex tw-flex-col tw-gap-4 tw-p-4">
                        <div class="tw-border-b tw-pb-4">
                            <ApplicationLogo class="tw-text-black tw-h-8 tw-w-8"/>
                        </div>
                        <ul class="tw-flex tw-flex-col tw-gap-4">
                            <li v-for="link in links" :key="link.name" v-can="link.can" :class="{'tw-flex tw-items-center tw-gap-3': !!link.children}">
                                <div v-if="!!link.children" class="tw-text-[15px] tw-cursor-pointer" :class="{'tw-text-indigo-500': isActive(link.routeActive), 'tw-text-gray-400': !isActive(link.routeActive)}">
                                    <div class="tw-flex tw-items-center tw-gap-2">
                                        <i :class="link.icon" class="tw-text-[15px]"></i>
                                        <span>{{ link.name }}</span>
                                    </div>
                                    <div class="tw-mt-3 tw-ml-2">
                                        <ul>
                                            <li v-for="(item, index) in link.children" :key="index" :class="{'tw-flex tw-items-center tw-gap-3': !!item.children}">
                                                <Link :href="item.href" v-can="item.can" class="hover:tw-bg-gray-100 tw-w-full tw-py-2 tw-px-4 tw-text-gray-400">--- {{item.name}}</Link>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <Link v-else :href="link.href" class="tw-text-[15px] tw-flex tw-items-center tw-gap-2" :class="{'tw-text-indigo-500': isActive(link.routeActive), 'tw-text-gray-400': !isActive(link.routeActive)}">
                                    <i :class="link.icon" class="tw-text-[15px]"></i>
                                    <span>{{ link.name }}</span>
                                    <i v-if="!!link.children" class='bx bx-chevron-down tw-text-[16px] tw-text-inherit'></i>
                                </Link>
                            </li>
                        </ul>
                    </div>
                </q-scroll-area>
            </q-drawer>
        </q-layout>
    </div>
</div>
</template>

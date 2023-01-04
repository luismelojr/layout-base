<script setup>
import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
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
        <div class="tw-w-full md:tw-hidden" :class="{'tw-mt-4': mobileMenuOpen}">
            <button class="tw-cursor-pointer" @click="toggleMenu">
                <i class='bx bx-menu tw-text-[24px]'></i>
            </button>
        </div>
    </div>
    <div v-if="mobileMenuOpen" class="tw-bg-white tw-w-full tw-px-[24px] tw-py-4 tw-border-t tw-mt-2 tw-shadow">
        <ul class="tw-w-full tw-items-start tw-gap-4 -tw-ml-1 tw-flex tw-flex-col">
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
    </div>
</div>
</template>

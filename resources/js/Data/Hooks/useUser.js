import { usePage } from '@inertiajs/inertia-vue3'

export default function useUser() {
    let user = usePage().props.value.auth.user
    user.permissions = usePage().props.value.auth.permissions
    return user
}

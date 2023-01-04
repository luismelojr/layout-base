import useUser from "@/Data/Hooks/useUser";

export default function CanDirective(el, binding) {
    const user = useUser();
    const permissions = binding.value;
    let hasPermission = false
    if (typeof permissions === 'string') {
        hasPermission = user.permissions.includes(permissions);
    }
    if (typeof permissions === "undefined") hasPermission = true;

    if (typeof permissions === 'object') {
        const value = permissions.map((permission) => {
            return user.permissions.includes(permission);
        });
        hasPermission = value.includes(true);
    }

    if (!hasPermission) {
        el.remove()
    }
}

<script setup>
import { useModal } from 'momentum-modal'
const { show, redirect } = useModal()
</script>
<template>
    <q-dialog
        :model-value="show"
        @hide="redirect"
    >
        <slot />
    </q-dialog>
</template>


<script setup>
import { useModal } from 'momentum-modal'
const { show, redirect } = useModal()
</script>
<template>
    <q-dialog
        :model-value="show"
        maximized
        @hide="redirect"
    >
        <div class="tw-bg-white" style="width: 400px">
            <slot />
        </div>
    </q-dialog>
</template>

<script setup>
import Desktop from '../Components/Desktop.vue';
import Toolbar from '../Components/Toolbar.vue';

const emit = defineEmits(['logout', 'shutdown']);
</script>

<template>
    <main class="os">
        <Desktop />
        <Toolbar @logout="$emit('logout')" @shutdown="$emit('shutdown')" />
    </main>
</template>
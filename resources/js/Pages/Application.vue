<script setup>
import { onMounted, ref } from 'vue';
import Boot from './Boot.vue';
import PickUser from './PickUser.vue';
import OS from './OS.vue';

const STATES = {
    BOOTING: 0,
    PICK_USER: 1,
    OS: 2,
};

const state = ref(STATES.BOOTING);
const args = ref({});

onMounted(() => {
    // STOP RIGHT MOUSE CLICK
    // document.addEventListener('contextmenu', (e) => {
    //     e.preventDefault();
    // });
});

function logout() {
    args.value = { action: 'logout' };
    state.value = STATES.PICK_USER;
}

function shutdown() {
    args.value = { action: 'shutdown' };
    state.value = STATES.PICK_USER;
}
</script>

<template>
    <Boot v-if="state == STATES.BOOTING" @booted="state = STATES.PICK_USER" />
    <PickUser v-if="state == STATES.PICK_USER" :args="args" @loaded="state = STATES.OS" />
    <OS v-if="state == STATES.OS" @logout="logout" @shutdown="shutdown" />
</template>
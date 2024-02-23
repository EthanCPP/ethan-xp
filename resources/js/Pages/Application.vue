<script setup>
import { ref } from 'vue';
import Boot from './Boot.vue';
import PickUser from './PickUser.vue';

const STATES = {
    BOOTING: 0,
    PICK_USER: 1,
};

const state = ref(STATES.BOOTING);
</script>

<template>
    <Boot v-if="state == STATES.BOOTING" @booted="state = STATES.PICK_USER" />
    <PickUser v-if="state == STATES.PICK_USER" />
</template>
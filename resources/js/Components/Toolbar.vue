<script setup>
import { onMounted, ref } from 'vue';
import StartMenu from './StartMenu.vue';

const emit = defineEmits(['logout', 'shutdown']);

const time = ref('');
const startOpen = ref(false);

function setTime() {
    const date = new Date();
    time.value = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
}

onMounted(() => {
    setTime();

    setInterval(() => {
        setTime();
    }, 60000);
});
</script>

<template>
    <StartMenu v-if="startOpen" @logout="$emit('logout')" @shutdown="$emit('shutdown')" />
    <div class="toolbar">
        <button 
            type="button" 
            @click="startOpen = !startOpen"
            :class="[
                'btn',
                'toolbar__start',
                startOpen ? 'toolbar__start--open' : '',
            ]"
        >
            <span class="toolbar__start__label">start</span>
        </button>

        <div class="toolbar__shortcuts">
            <span class="toolbar__shortcuts__time">{{ time }}</span>
        </div>
    </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';
import StartMenu from './StartMenu.vue';
import Icons from '@/Util/Icons';
import ToolbarTm from './ToolbarTm.vue';

const emit = defineEmits(['logout', 'shutdown', 'startApplication']);

const time = ref('');
const startOpen = ref(false);

function setTime() {
    const date = new Date();
    time.value = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
}

function startApplication(application, target, other) {
    startOpen.value = false;
    emit('startApplication', application, target, other);
}

onMounted(() => {
    setTime();

    setInterval(() => {
        setTime();
    }, 60000);

    //TODO this is quite heavy. Improve this?
    document.addEventListener('mousedown', function(e) {
        const startMenu = document.querySelector('.start-menu');

        if (startMenu) {
            if (! startMenu.contains(e.target) && 
                ! e.target.classList.contains('toolbar__start') &&
                ! document.querySelector('.toolbar__start').contains(e.target)
            ) {
                startOpen.value = false;
            }
        }
    })
});
</script>

<template>
    <StartMenu v-if="startOpen" @logout="$emit('logout')" @shutdown="$emit('shutdown')" @start-application="startApplication" />
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
            <span class="toolbar__start__label">
                <img :src="Icons.windows" />
                start
            </span>
        </button>

        <div class="toolbar__shortcuts">
            <ToolbarTm />

            <span class="toolbar__shortcuts__time">{{ time }}</span>
        </div>
    </div>
</template>
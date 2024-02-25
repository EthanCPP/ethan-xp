<script setup>
import { onMounted } from 'vue';
import Icons from '../../Util/Icons';

const emit = defineEmits(['close']);
const props = defineProps(['target', 'other']);

onMounted(() => {
    const criticalAudio = new Audio('/audio/critical.mp3');
    criticalAudio.play();
})
</script>

<template>
    <div class="error-msg">
        <div class="error-msg__titlebar">
            <span class="error-msg__titlebar__title">Error</span>
            <button type="button" class="btn error-msg__titlebar__close" @click="$emit('close')"><div></div><div></div></button>
        </div>

        <div class="error-msg__content">
            <div class="error-msg__content-inner">
                <div class="error-msg__content-left">
                    <img :src="Icons.errorButton" class="error-msg__error-icon" />
                </div>
                <div class="error-msg__content-right">
                    {{ other.other }}
                </div>
            </div>

            <button type="button" class="btn error-msg__ok" @click="$emit('close')">OK</button>
        </div>
    </div>
</template>
<script setup>
import { onMounted } from 'vue';
import Icons from '../../Util/Icons';

const emit = defineEmits(['close']);
const props = defineProps(['target', 'other']);

onMounted(() => {
    const successAudio = new Audio('/audio/tada.mp3');
    successAudio.play();
})
</script>

<template>
    <div class="error-msg">
        <div class="error-msg__titlebar">
            <span class="error-msg__titlebar__title">Success</span>
            <button type="button" class="btn error-msg__titlebar__close" @click="$emit('close')"><div></div><div></div></button>
        </div>

        <div class="error-msg__content">
            <div class="error-msg__content-inner">
                <div class="error-msg__content-left">
                    <img :src="Icons.infoBubble" class="error-msg__error-icon" />
                </div>
                <div class="error-msg__content-right">
                    <span v-if="other.other != ''">{{ other.other }}</span>
                    <span v-else>Something good happened, probably</span>
                </div>
            </div>

            <button type="button" class="btn error-msg__ok" @click="$emit('close')">OK</button>
        </div>
    </div>
</template>
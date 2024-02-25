<script setup>
import { ref } from 'vue';

const emit = defineEmits(['startApplication']);
const props = defineProps(['icon', 'title', 'opens']);

const singleClick = ref(false);
const lastClickAt = ref(null);

function fileClick() {
    if (props.opens) {
        singleClick.value = true;

        const currentTime = (new Date()).getTime();

        if (currentTime - lastClickAt.value <= 700) {
            emit('startApplication', props.opens.application, props.opens.target ?? null, props.opens.other ?? null);
            lastClickAt.value = 0;
        } else {
            lastClickAt.value = currentTime;
        }
    }
}
</script>

<template>
    <button
        @click="fileClick"
        type="button" 
        class="btn explorer-file"
    >
        <img :src="icon" class="explorer-file__icon" />
        <span class="explorer-file__title">{{ title }}</span>
    </button>
</template>
<script setup>
import { onMounted, ref } from 'vue';

const emit = defineEmits(['open']);
const props = defineProps(['icon', 'name', 'application', 'target', 'other']);

const shortcut = ref(null);

const singleClick = ref(false);
const lastClickAt = ref(null);

function getName() {
    if (props.name.length > 20 && !singleClick.value) {
        return props.name.substr(0, 20) + '...';
    }

    return props.name;
}

function shortcutClick() {
    singleClick.value = true;

    const currentTime = (new Date()).getTime();

    if (currentTime - lastClickAt.value <= 700) {
        emit('open', props.application, props.target ?? null, props.other ?? null);
        lastClickAt.value = 0;
    } else {
        lastClickAt.value = currentTime;
    }
}

onMounted(() => {
    document.addEventListener('click', function(e) {
        if (! shortcut.value.contains(e.target) && shortcut.value != e.target) {
            singleClick.value = false;
        }
    });
});
</script>

<template>
    <button 
        @click="shortcutClick" 
        type="button" 
        :class="[
            'btn',
            'desktop-shortcut',
            singleClick ? 'desktop-shortcut--selected' : '',
        ]"
        ref="shortcut"
    >
        <img :src="icon" class="desktop-shortcut__icon" />
        <span class="desktop-shortcut__name"><span>{{ getName() }}</span></span>
    </button>
</template>
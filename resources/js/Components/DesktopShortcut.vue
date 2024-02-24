<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps(['icon', 'name']);

const shortcut = ref(null);

const singleClick = ref(false);

function getName() {
    if (props.name.length > 20 && !singleClick.value) {
        return props.name.substr(0, 20) + '...';
    }

    return props.name;
}

function shortcutClick() {
    singleClick.value = true;
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
    <button @click="shortcutClick" type="button" class="btn desktop-shortcut" ref="shortcut">
        <img :src="icon" class="desktop-shortcut__icon" />
        <span class="desktop-shortcut__name">{{ getName() }}</span>
    </button>
</template>
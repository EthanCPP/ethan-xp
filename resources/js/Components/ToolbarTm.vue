<script setup>
import { onMounted, ref } from 'vue';
import Icons from '../Util/Icons';

const icon = ref(Icons.tm1);

onMounted(() => {
    setInterval(() => {
        const cpu = Math.round(Math.random() * 10) + 1;
        icon.value = Icons['tm' + cpu];
    }, 500);
});
</script>

<template>
    <div class="toolbar__shortcuts__tm">
        <img :src="icon" />
    </div>
</template>
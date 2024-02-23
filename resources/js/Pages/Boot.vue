<script setup>
import bootLogo from '@/../image/boot-logo.png';
import { onMounted, ref } from 'vue';

const emit = defineEmits('booted');

const showBoot = ref(false);
const bootLoader = ref(null);
const segmentX = ref(0);

onMounted(() => {
    setTimeout(() => {
        showBoot.value = true;

        setInterval(() => {
            segmentX.value += 20;

            if (segmentX.value - 80 >= bootLoader.value.clientWidth) {
                segmentX.value = 0;
            }
        }, 120);
    }, 1000);

    setTimeout(() => {
        showBoot.value = false;
    }, 7000);

    setTimeout(() => {
        emit('booted');
    }, 9000);
});
</script>

<template>
    <main id="page-boot">
        <div 
            :class="[
                'boot',
                showBoot ? 'boot--show' : '',
            ]"
        >
            <img :src="bootLogo" class="boot__logo" />

            <div class="boot__loader" ref="bootLoader">
                <span 
                    v-for="i in 3"
                    class="boot__loader__segment"
                    :style="'left: ' + segmentX + 'px'"
                ></span>
            </div>
        </div>
    </main>
</template>
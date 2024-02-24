<script setup>
import Bliss from '@/../image/bliss.webp';
import DesktopShortcut from './DesktopShortcut.vue';
import Icons from '../Util/Icons';

const emit = defineEmits([''])
</script>

<template>
    <div class="desktop">
        <img :src="Bliss" class="desktop__wallpaper" />

        <div class="desktop__shortcuts">
            <DesktopShortcut :icon="Icons.binEmpty" name="Recycle Bin" />
            <DesktopShortcut :icon="Icons.folder" name="Something" />
        </div>  
    </div>
</template>
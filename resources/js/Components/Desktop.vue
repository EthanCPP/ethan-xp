<script setup>
import Bliss from '@/../image/bliss.webp';
import DesktopShortcut from './DesktopShortcut.vue';
import Icons from '../Util/Icons';
import RecycleBin from './Applications/RecycleBin.vue';

const emit = defineEmits(['startApplication']);

function startApplication(application) {
    emit('startApplication', application);
}
</script>

<template>
    <div class="desktop">
        <img :src="Bliss" class="desktop__wallpaper" />

        <div class="desktop__shortcuts">
            <DesktopShortcut :icon="Icons.binEmpty" name="Recycle Bin" :application="RecycleBin" @open="startApplication" />
            <DesktopShortcut :icon="Icons.folder" name="Something" />
        </div>  
    </div>
</template>
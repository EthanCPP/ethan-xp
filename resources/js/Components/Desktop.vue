<script setup>
import Bliss from '@/../image/bliss.webp';
import DesktopShortcut from './DesktopShortcut.vue';
import Icons from '../Util/Icons';
import FileExplorer from './Applications/FileExplorer.vue';
import { ref } from 'vue';

const emit = defineEmits(['startApplication']);

const shortcuts = ref([
    { icon: Icons.binEmpty, name: 'Recycle Bin', application: FileExplorer, target: 'recycle-bin' },
    { icon: Icons.folder, name: 'Some project', application: FileExplorer, target: 'some-project' },
])

function startApplication(application, target, other) {
    emit('startApplication', application, target, other);
}
</script>

<template>
    <div class="desktop">
        <img :src="Bliss" class="desktop__wallpaper" />

        <div class="desktop__shortcuts">
            <DesktopShortcut
                v-if="shortcuts"
                v-for="shortcut in shortcuts"
                :icon="shortcut.icon"
                :name="shortcut.name"
                :application="shortcut.application"
                :target="shortcut.target"
                @open="startApplication"
            />
        </div>  
    </div>
</template>
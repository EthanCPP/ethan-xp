<script setup>
import Bliss from '@/../image/bliss.webp';
import DesktopShortcut from './DesktopShortcut.vue';
import Icons from '../Util/Icons';
import FileExplorer from './Applications/FileExplorer.vue';
import { onMounted, ref } from 'vue';
import Api from '../Util/Api';

const emit = defineEmits(['startApplication']);

const shortcuts = ref([
    // { icon: Icons.binEmpty, name: 'Recycle Bin', application: FileExplorer, target: 'recycle-bin' },
    // { icon: Icons.folder, name: 'Some project', application: FileExplorer, target: 'some-project' },
]);

let api;

function startApplication(application, target, other) {
    emit('startApplication', application, target, other);
}

onMounted(() => {
    api = new Api();

    getFiles();
});

async function getFiles() {
    const files = await api.getFilesAtLocation('desktop');

    if (files) {
        files.forEach(function(file) {
            shortcuts.value.push({
                icon: Icons[file.icon],
                name: file.name,
                application: file.application,
                target: 'generic-file',
                other: file,
            });
        });
    }
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
                :other="shortcut.other"
                @open="startApplication"
            />
        </div>  
    </div>
</template>
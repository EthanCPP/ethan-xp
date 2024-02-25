<script setup>
import Icons from '../../../Util/Icons';
import ExplorerFile from '../../ExplorerFile.vue';
import FileExplorer from '../FileExplorer.vue';
import Notepad from '../Notepad.vue';

const emit = defineEmits(['startApplication']);

function startApplication(application, target, other) {
    console.log('start', application, target, other);
    emit('startApplication', application, target, other);
}
</script>

<template>
    <div class="file-explorer__files">
        <ExplorerFile 
            :icon="Icons.iePage" 
            title="Website" 
            :opens="{application: FileExplorer, target: 'internet-explorer', other: {url: 'https://wikipedia.org'}}"
            @start-application="startApplication"
        />

        <ExplorerFile 
            :icon="Icons.notepad" 
            title="About the project" 
            :opens="{application: Notepad, target: 'SomeProjectAboutTheProject', other: {title: 'About the project'}}"    
            @start-application="startApplication"
        />
    </div>
</template>
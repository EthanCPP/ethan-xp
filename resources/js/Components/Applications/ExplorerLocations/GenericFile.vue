<script setup>
import { onMounted, ref } from 'vue';
import Api from '../../../Util/Api';
import Icons from '../../../Util/Icons';
import ExplorerFile from '../../ExplorerFile.vue';

const props = defineProps(['other']);

const emit = defineEmits(['startApplication']);

const fileList = ref([]);

let api;

onMounted(() => {
    api = new Api();

    getFiles();
});

async function getFiles() {
    const files = await api.getFilesInFolder(props.other.id);

    if (files) {
        files.forEach(function(file) {
            fileList.value.push({
                icon: Icons[file.icon],
                name: file.name,
                application: file.application,
                target: 'generic-file',
                other: file,
            });
        });
    }
}

function startApplication(application, target, other) {
    emit('startApplication', application, target, other);
}
</script>

<template>
    <div class="file-explorer__files">
        <ExplorerFile
            v-if="fileList.length"
            v-for="file in fileList" 
            :icon="file.icon" 
            :title="file.name"
            :opens="file"    
            @start-application="startApplication"
        />
    </div>
</template>
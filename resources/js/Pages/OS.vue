<script setup>
import { ref } from 'vue';
import Desktop from '../Components/Desktop.vue';
import Toolbar from '../Components/Toolbar.vue';
import FileExplorer from '../Components/Applications/FileExplorer.vue';
import Notepad from '../Components/Applications/Notepad.vue';
import ErrorMsg from '../Components/Applications/ErrorMsg.vue'
import Outlook from '../Components/Applications/Outlook.vue';
import InfoMsg from '../Components/Applications/InfoMsg.vue';

const emit = defineEmits(['logout', 'shutdown']);

const os = ref(null);
const applications = ref([]);
const currentZIndex = ref(0);

function spawnApplication(component, target = '', other = '') {
    currentZIndex.value++;

    applications.value.push({
        component,
        zIndex: currentZIndex.value,
        target,
        other,
    });
}

function bringToFront(index) {
    currentZIndex.value++;
    applications.value[index].zIndex = currentZIndex.value;
}

function startApplication(application, target = '', other = '') {
    let component;

    switch (application) {
        case 'file-explorer': component = FileExplorer; break;
        case 'notepad': component = Notepad; break;
        case 'error': component = ErrorMsg; break;
        case 'outlook': component = Outlook; break;
        case 'info': component = InfoMsg; break;
    }

    spawnApplication(component, target, other);
}

function closeApplication(index) {
    delete applications.value[index];
}
</script>

<template>
    <main class="os" ref="os">
        <Toolbar @logout="$emit('logout')" @shutdown="$emit('shutdown')" @start-application="startApplication" />

        <div class="os__main">
            <Desktop @startApplication="startApplication" />

            <component
                v-if="applications.length"
                v-for="(application, index) in applications"
                :is="application?.component"
                :z-index="application?.zIndex"
                :target="application?.target"
                :other="application?.other"
                @mousedown="bringToFront(index)"
                @close="closeApplication(index)"
                @startApplication="startApplication"
            />
        </div>
    </main>
</template>
<script setup>
import { ref } from 'vue';
import Desktop from '../Components/Desktop.vue';
import Toolbar from '../Components/Toolbar.vue';

const emit = defineEmits(['logout', 'shutdown']);

const os = ref(null);
const applications = ref([]);
const currentZIndex = ref(0);

function spawnApplication(component) {
    currentZIndex.value++;

    applications.value.push({
        component,
        zIndex: currentZIndex.value,
    });
}

function bringToFront(index) {
    currentZIndex.value++;
    applications.value[index].zIndex = currentZIndex.value;
}

function startApplication(application) {
    spawnApplication(application);
}

function closeApplication(index) {
    delete applications.value[index];
}
</script>

<template>
    <main class="os" ref="os">
        <Toolbar @logout="$emit('logout')" @shutdown="$emit('shutdown')" />

        <div class="os__main">
            <Desktop @startApplication="startApplication" />

            <component
                v-if="applications.length"
                v-for="(application, index) in applications"
                :is="application?.component"
                :z-index="application?.zIndex"
                @mousedown="bringToFront(index)"
                @close="closeApplication(index)"
            />
        </div>
    </main>
</template>
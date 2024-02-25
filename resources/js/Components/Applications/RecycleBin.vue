<script setup>
import Icons from '../../Util/Icons';
import FileExplorer from '../FileExplorer.vue';
import Application from './../Application.vue';
</script>

<template>
    <Application :icon="Icons.binEmpty" title="Recycle Bin">
        <FileExplorer address="Recycle Bin">
        </FileExplorer>
    </Application>
</template>
<script setup>
import Icons from '../../../Util/Icons';
import ExplorerFile from '../../ExplorerFile.vue';

</script>

<template>
    <div class="file-explorer__files">
        <ExplorerFile :icon="Icons.zip" title="My worst fears" />
    </div>
</template>
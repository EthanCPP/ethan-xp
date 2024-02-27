<script setup>
import Icons from '../../Util/Icons';
import Application from '../Application.vue';
</script>

<template>
    <Application :icon="Icons.minesweeper" title="Mineswe..." max-disabled="true" width="240" height="320">
        <div class="minesweeper">
            <div class="minesweeper__scorebar">
                <div class="minesweeper__counter">000</div>
                <button type="button" class="btn minesweeper__restart"></button>
                <div class="minesweeper__counter">000</div>
            </div>

            <div class="minesweeper__stage">

            </div>
        </div>
    </Application>
</template>
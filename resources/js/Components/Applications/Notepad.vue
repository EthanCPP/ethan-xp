<script setup>
import Icons from '../../Util/Icons';
import Application from '../Application.vue';
import NotepadData from '../../Util/NotepadData';

const props = defineProps(['target', 'other']);
</script>

<template>
    <Application :icon="Icons.notepad" :title="other.title + ' - Notepad'">
        <div class="notepad">
            <div class="notepad__toolbar">
                <button type="button" class="btn notepad__toolbar__btn">File</button>
                <button type="button" class="btn notepad__toolbar__btn">Edit</button>
                <button type="button" class="btn notepad__toolbar__btn">View</button>
                <button type="button" class="btn notepad__toolbar__btn">Favorites</button>
                <button type="button" class="btn notepad__toolbar__btn">Tools</button>
                <button type="button" class="btn notepad__toolbar__btn">Help</button>
            </div>

            <div class="notepad__content" v-html="NotepadData[target]"></div>
        </div>
    </Application>
</template>
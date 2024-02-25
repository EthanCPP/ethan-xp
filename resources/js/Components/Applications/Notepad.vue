<script setup>
import Icons from '../../Util/Icons';
import Application from '../Application.vue';
import NotepadData from '../../Util/NotepadData';

const props = defineProps(['target', 'other']);

function getName() {
    if (props.other.name == 'Notepad') {
        return 'Untitled - Notepad';
    }

    return props.other.name + ' - Notepad';
}
</script>

<template>
    <Application :icon="Icons.notepad" :title="getName()">
        <div class="notepad">
            <div class="notepad__toolbar">
                <button type="button" class="btn notepad__toolbar__btn">File</button>
                <button type="button" class="btn notepad__toolbar__btn">Edit</button>
                <button type="button" class="btn notepad__toolbar__btn">View</button>
                <button type="button" class="btn notepad__toolbar__btn">Favorites</button>
                <button type="button" class="btn notepad__toolbar__btn">Tools</button>
                <button type="button" class="btn notepad__toolbar__btn">Help</button>
            </div>

            <textarea class="notepad__content" v-html="other.other"></textarea>
        </div>
    </Application>
</template>
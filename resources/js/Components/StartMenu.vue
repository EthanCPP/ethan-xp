<script setup>
import { onMounted, ref } from 'vue';
import Icons from '../Util/Icons';
import UserIconFrog from '@/../image/user/frog.bmp';
import Api from '../Util/Api';


const emit = defineEmits(['logout', 'shutdown', 'startApplication']);

const allProgramsListOpen = ref(false);

const programList = ref([]);
const allProgramsList = ref([]);
const favouritesList = ref([]);

let api;

onMounted(() => {
    api = new Api();

    hydrateList('start', programList);
    hydrateList('all-programs', allProgramsList);
    hydrateList('favourite-programs', favouritesList);
});

async function hydrateList(name, list) {
    const programs = await api.getFilesAtLocation(name);

    if (programs) {
        programs.forEach(function(file) {
            list.value.push({
                icon: Icons[file.icon],
                name: file.name,
                application: file.application,
                target: file.target,
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
    <div class="start-menu">
        <div class="start-menu__header">
            <div class="start-menu__header__user-profile">
                <img :src="UserIconFrog" class="start-menu__header__user-image" />
            </div>
            <span class="start-menu__header__user-name">Ethan</span>
        </div>
        <div class="start-menu__body">
            <div class="start-menu__quicklaunch">
                <button
                    v-if="programList.length"
                    v-for="program in programList"
                    class="btn start-menu__quicklaunch-item" 
                    @click="startApplication(program.application, program.target, program.other)"
                >
                    <img :src="program.icon" class="start-menu__quicklaunch-item__icon" />
                    <span class="start-menu__quicklaunch-item__name">{{ program.name }}</span>
                </button>

                <div class="start-menu__all-programs">
                    <button @click="allProgramsListOpen = !allProgramsListOpen" type="button" class="btn start-menu__all-programs-btn">
                        <span>All Programs</span>
                        <img :src="Icons.play" />
                    </button>
                </div>

                <div 
                    :class="[
                        'start-menu__all-programs-list',
                        allProgramsListOpen ? 'start-menu__all-programs-list--open' : '',
                    ]"
                >
                    <button
                        v-if="allProgramsList.length"
                        v-for="program in allProgramsList"
                        class="btn start-menu__all-programs-list__item" 
                        @click="startApplication(program.application, program.target, program.other)"
                    >
                        <img :src="program.icon" />
                        <span>{{ program.name }}</span>
                    </button>
                </div>
            </div>
            <div class="start-menu__explore">
                <button
                    v-if="favouritesList.length"
                    v-for="program in favouritesList"
                    class="btn start-menu__explore-item" 
                    @click="startApplication(program.application, program.target, program.other)"
                >
                    <img :src="program.icon" class="start-menu__explore-item__icon" />
                    <span class="start-menu__explore-item__name">{{ program.name }}</span>
                </button>
            </div>
        </div>
        <div class="start-menu__footer">
            <button type="button" class="btn start-menu__footer-btn" @click="$emit('logout')">
                <img :src="Icons.logoff" />
                <span>Log Off</span>
            </button>
            <button type="button" class="btn start-menu__footer-btn" @click="$emit('shutdown')">
                <img :src="Icons.shutdown" />
                <span>Turn Off Computer</span>
            </button>
        </div>
    </div>
</template>
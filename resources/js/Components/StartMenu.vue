<script setup>
import { ref } from 'vue';
import Icons from '../Util/Icons';
import UserIconFrog from '@/../image/user/frog.bmp';


const emit = defineEmits(['logout', 'shutdown']);

const allProgramsList = ref(false);
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
                <button type="button" class="btn start-menu__quicklaunch-item">
                    <img :src="Icons.ie" class="start-menu__quicklaunch-item__icon" />
                    <span class="start-menu__quicklaunch-item__name">Internet Explorer</span>
                </button>
                <button type="button" class="btn start-menu__quicklaunch-item">
                    <img :src="Icons.outlook" class="start-menu__quicklaunch-item__icon" />
                    <span class="start-menu__quicklaunch-item__name">Outlook Express</span>
                </button>
                <button type="button" class="btn start-menu__quicklaunch-item">
                    <img :src="Icons.wmp" class="start-menu__quicklaunch-item__icon" />
                    <span class="start-menu__quicklaunch-item__name">Windows Media Player</span>
                </button>
                <button type="button" class="btn start-menu__quicklaunch-item">
                    <img :src="Icons.msm" class="start-menu__quicklaunch-item__icon" />
                    <span class="start-menu__quicklaunch-item__name">Windows Messenger</span>
                </button>
                <button type="button" class="btn start-menu__quicklaunch-item">
                    <img :src="Icons.cmd" class="start-menu__quicklaunch-item__icon" />
                    <span class="start-menu__quicklaunch-item__name">Command Prompt</span>
                </button>

                <div class="start-menu__all-programs">
                    <button @click="allProgramsList = !allProgramsList" type="button" class="btn start-menu__all-programs-btn">
                        <span>All Programs</span>
                        <img :src="Icons.play" />
                    </button>
                </div>

                <div 
                    :class="[
                        'start-menu__all-programs-list',
                        allProgramsList ? 'start-menu__all-programs-list--open' : '',
                    ]"
                >
                    <button type="button" class="btn start-menu__all-programs-list__item">
                        <img :src="Icons.ie" />
                        <span>Internet Explorer</span>
                    </button>
                    <button type="button" class="btn start-menu__all-programs-list__item">
                        <img :src="Icons.outlook" />
                        <span>Outlook Express</span>
                    </button>
                    <button type="button" class="btn start-menu__all-programs-list__item">
                        <img :src="Icons.wmp" />
                        <span>Windows Media Player</span>
                    </button>
                    <button type="button" class="btn start-menu__all-programs-list__item">
                        <img :src="Icons.msm" />
                        <span>Windows Messenger</span>
                    </button>
                    <button type="button" class="btn start-menu__all-programs-list__item">
                        <img :src="Icons.notepad" />
                        <span>Notepad</span>
                    </button>
                    <button type="button" class="btn start-menu__all-programs-list__item">
                        <img :src="Icons.pinball" />
                        <span>Pinball</span>
                    </button>
                    <button type="button" class="btn start-menu__all-programs-list__item">
                        <img :src="Icons.minesweeper" />
                        <span>Minesweeper</span>
                    </button>
                    <button type="button" class="btn start-menu__all-programs-list__item">
                        <img :src="Icons.cmd" />
                        <span>Command Prompt</span>
                    </button>
                </div>
            </div>
            <div class="start-menu__explore">
                <button type="button" class="btn start-menu__explore-item">
                    <img :src="Icons.folderDocs2" class="start-menu__explore-item__icon" />
                    <span class="start-menu__explore-item__name">My Documents</span>
                </button>
                <button type="button" class="btn start-menu__explore-item">
                    <img :src="Icons.folderVideo" class="start-menu__explore-item__icon" />
                    <span class="start-menu__explore-item__name">My Videos</span>
                </button>
                <button type="button" class="btn start-menu__explore-item">
                    <img :src="Icons.folderPics" class="start-menu__explore-item__icon" />
                    <span class="start-menu__explore-item__name">My Pictures</span>
                </button>
                <button type="button" class="btn start-menu__explore-item">
                    <img :src="Icons.computer" class="start-menu__explore-item__icon" />
                    <span class="start-menu__explore-item__name">My Computer</span>
                </button>
                <button type="button" class="btn start-menu__explore-item">
                    <img :src="Icons.control" class="start-menu__explore-item__icon" />
                    <span class="start-menu__explore-item__name">Control Panel</span>
                </button>
                <button type="button" class="btn start-menu__explore-item">
                    <img :src="Icons.helpCircle" class="start-menu__explore-item__icon" />
                    <span class="start-menu__explore-item__name">Help and Support</span>
                </button>
                <button type="button" class="btn start-menu__explore-item">
                    <img :src="Icons.search" class="start-menu__explore-item__icon" />
                    <span class="start-menu__explore-item__name">Search</span>
                </button>
                <button type="button" class="btn start-menu__explore-item">
                    <img :src="Icons.run" class="start-menu__explore-item__icon" />
                    <span class="start-menu__explore-item__name">Run...</span>
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
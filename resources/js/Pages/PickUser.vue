<script setup>
import bootLogo from '@/../image/boot-logo.png';
import { onMounted, ref } from 'vue';
import UserIconFrog from '@/../image/user/frog.bmp';
import UserIconDuck from '@/../image/user/duck.bmp';
import Icons from '../Util/Icons';

const props = defineProps(['args']);
const emit = defineEmits(['loaded']);

const loadingUser = ref(false);
const selectedUser = ref(null);
const loggingOff = ref(false);
const shuttingDown = ref(false);
const startupAudio = new Audio('/audio/startup.mp3');
const loginAudio = new Audio('/audio/logon.mp3');

onMounted(() => {
    if (props.args?.action == 'logout') {
        loggingOff.value = true;

        const logoutAudio = new Audio('/audio/logoff.mp3');
        logoutAudio.play();

        setTimeout(() => {
            loggingOff.value = false;
        }, 2000);
    }

    if (props.args?.action == 'shutdown') {
        loggingOff.value = true;

        const shutdownAudio = new Audio('/audio/shutdown.mp3');
        shutdownAudio.play();

        setTimeout(() => {
            shuttingDown.value = true;

            setTimeout(() => {
                alert('done');
            }, 2000);
        }, 2000);
    }
});

function selectUser(user) {
    if (! loadingUser.value) {
        loadingUser.value = true;
        selectedUser.value = user;

        if (props.args?.action == 'logout') {
            loginAudio.play();
        } else {
            startupAudio.play();
        }

        setTimeout(() => {
            emit('loaded');
        }, 3000);
    }
}
</script>

<template>
    <main id="page-pick-user">
        <div class="pick-layout">
            <div class="pick-layout__top"></div>

            <div class="pick-layout__stage" v-if="loggingOff">
                <div class="pick-layout__left"></div>
                <div class="pick-layout__right">
                    <img :src="bootLogo" class="pick-layout__logout-logo" />
                    <span class="pick-layout__logout-prompt" v-if="loggingOff && !shuttingDown">Logging off...</span>
                    <span class="pick-layout__logout-prompt" v-if="shuttingDown">Ethan XP is shutting down...</span>
                </div>
            </div>
            <div class="pick-layout__stage" v-else-if="!loadingUser">
                <div class="pick-layout__left">
                    <img :src="bootLogo" class="pick-layout__logo" />
                    <span class="pick-layout__prompt">To begin, click your user name</span>
                </div>

                <div class="pick-layout__divider"></div>

                <div class="pick-layout__right">
                    <div class="pick-layout__user">
                        <button @click="selectUser('Guest')" type="button" class="btn pick-layout__user__link"></button>

                        <div class="pick-layout__user__inner">
                            <div class="pick-layout__user__profile">
                                <img class="pick-layout__user__image" :src="UserIconFrog" />
                            </div>

                            <div class="pick-layout__user__content">
                                <span class="pick-layout__user__name">Guest</span>
                            </div>
                        </div>  
                    </div>

                    <div class="pick-layout__user pick-layout__user--protected">
                        <button type="button" class="btn pick-layout__user__link"></button>
                        
                        <div class="pick-layout__user__inner">
                            <div class="pick-layout__user__profile">
                                <img class="pick-layout__user__image" :src="UserIconDuck" />
                            </div>

                            <div class="pick-layout__user__content">
                                <span class="pick-layout__user__name">Ethan</span>

                                <div class="pick-layout__user__password-wrap">
                                    <span class="pick-layout__user__password-prompt">Type your password</span>

                                    <div class="d-flex align-items-center gap-1">
                                        <input type="password" class="form-control pick-layout__user__password" />
                                        <button type="button" class="btn pick-layout__user__login-btn">
                                            <img :src="Icons.navNext" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="pick-layout__stage" v-else>
                <div class="pick-layout__left">
                    <span class="pick-layout__welcome">welcome</span>
                </div>

                <div class="pick-layout__divider"></div>

                <div class="pick-layout__right">
                    <div class="pick-layout__user pick-layout__user--selected">
                        <div class="pick-layout__user__inner">
                            <div class="pick-layout__user__profile">
                                <img class="pick-layout__user__image" src="https://via.placeholder.com/400x400" />
                            </div>

                            <div>
                                <span class="pick-layout__user__name">{{ selectedUser }}</span>
                                <span class="pick-layout__user__status">Loading your personal settings...</span>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="pick-layout__bottom"></div>
        </div>
    </main>
</template>
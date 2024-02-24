<script setup>

const emit = defineEmits(['logout', 'shutdown']);
</script>

<template>
    <div class="start-menu">
        <div class="start-menu__header">
            <div class="start-menu__header__user-profile">
                <img src="https://via.placeholder.com/200x200" class="start-menu__header__user-image" />
            </div>
            <span class="start-menu__header__user-name">Ethan</span>
        </div>
        <div class="start-menu__body">
            <div class="start-menu__quicklaunch">
                <button type="button" class="btn start-menu__quicklaunch-item">
                    <img src="https://via.placeholder.com/64x64" class="start-menu__quicklaunch-item__icon" />
                    <span class="start-menu__quicklaunch-item__name">Internet Explorer</span>
                </button>
                <button type="button" class="btn start-menu__quicklaunch-item">
                    <img src="https://via.placeholder.com/64x64" class="start-menu__quicklaunch-item__icon" />
                    <span class="start-menu__quicklaunch-item__name">Outlook Express Express Express Express</span>
                </button>
            </div>
            <div class="start-menu__explore">

            </div>
        </div>
        <div class="start-menu__footer">
            <button type="button" class="btn start-menu__footer-btn" @click="$emit('logout')"><span>Log Off</span></button>
            <button type="button" class="btn start-menu__footer-btn" @click="$emit('shutdown')"><span>Turn Off Computer</span></button>
        </div>
    </div>
</template>
<script setup>
import bootLogo from '@/../image/boot-logo.png';
</script>

<template>
    <main id="page-pick-user">
        <div class="pick-layout">
            <div class="pick-layout__top"></div>

            <div class="pick-layout__stage">
                <div class="pick-layout__left">
                    <img :src="bootLogo" class="pick-layout__logo" />
                    <span class="pick-layout__prompt">To begin, click your user name</span>
                </div>

                <div class="pick-layout__divider"></div>

                <div class="pick-layout__right">
                    <div class="pick-layout__user">
                        <button type="button" class="btn pick-layout__user__link"></button>

                        <div class="pick-layout__user__inner">
                            <div class="pick-layout__user__profile">
                                <img class="pick-layout__user__image" src="https://via.placeholder.com/400x400" />
                            </div>

                            <span class="pick-layout__user__name">Guest</span>
                        </div>  
                    </div>

                    <div class="pick-layout__user">
                        <button type="button" class="btn pick-layout__user__link"></button>
                        
                        <div class="pick-layout__user__inner">
                            <div class="pick-layout__user__profile">
                                <img class="pick-layout__user__image" src="https://via.placeholder.com/400x400" />
                            </div>

                            <span class="pick-layout__user__name">Ethan</span>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="pick-layout__bottom"></div>
        </div>
    </main>
</template>
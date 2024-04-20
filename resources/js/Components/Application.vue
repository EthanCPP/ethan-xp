<script setup>
import { onMounted, onUpdated, ref } from 'vue';

const props = defineProps(['icon', 'title', 'zIndex', 'width', 'height', 'maxDisabled', 'fitContent', 'startMaximised']);

const application = ref(null);
const appX = ref(0);
const appY = ref(0);

// Dragging logic
const dragging = ref(false);
const dragMX = ref(null);
const dragMY = ref(null);
const startX = ref(0);
const startY = ref(0);

// Maximise logic
const maximised = ref(false);
const maximisedStart = ref(false);
const savedX = ref(0);
const savedY = ref(0);

onMounted(() => {

    if (window.innerWidth > 992) {
        appX.value = (window.innerWidth / 2) - (application.value.offsetWidth / 2) + Math.ceil(Math.random() * 100);
        appY.value = (window.innerHeight / 2) - (application.value.offsetHeight / 2) + Math.ceil(Math.random() * 100);

        document.addEventListener('mousemove', function(e) {
            if (dragging.value && ! maximised.value) {
                e.preventDefault();

                const mX = e.clientX;
                const mY = e.clientY;

                if (dragMX.value === null && dragMY.value === null) {
                    dragMX.value = mX;
                    dragMY.value = mY;
                    startX.value = appX.value;
                    startY.value = appY.value;
                }

                appX.value = startX.value + (mX - dragMX.value);
                appY.value = startY.value + (mY - dragMY.value);
            }
        })
    } else {
        maximise();
    }
});

onUpdated(() => {
    if (props.startMaximised && ! maximisedStart.value) {
        maximisedStart.value = true;

        if (! maximised.value) {
            maximise();
        }
    }
})

function startDragging() {
    dragMX.value = null;
    dragMY.value = null;
    dragging.value = true;
}

function maximise() {
    if (props.maxDisabled) {
        return;
    }
    
    if (! maximised.value) {
        savedX.value = appX.value;
        savedY.value = appY.value;
        appX.value = 0;
        appY.value = 0;
        maximised.value = true;
    } else {
        appX.value = savedX.value;
        appY.value = savedY.value;
        maximised.value = false;
    }
}

function getStyle() {
    let style = '';
    
    style += `z-index: ${props.zIndex};`;
    style += `left: ${appX.value}px;`;
    style += `top: ${appY.value}px;`;

    if (! maximised.value) {
        if (props.fitContent) {
            style += `width: fit-content;`;
            style += `height: fit-content;`;
        } else {
            if (props.width) {
                style += `width: ${props.width}px;`;
            }

            if (props.height) {
                style += `height: ${props.height}px;`;
            }
        }
    }

    return style;
}
</script>

<template>
    <div 
        :class="[
            'application',
            maximised ? 'application--maximised' : '',
        ]" 
        :style="getStyle()"
        ref="application"
    >
        <div class="application__titlebar" @mousedown="startDragging" @mouseup="dragging = false">
            <div class="application__titlebar__left">
                <img :src="icon" class="application__titlebar__icon" />
                <span class="application__titlebar__title">{{ title }}</span>
            </div>

            <div class="application__titlebar__right">
                <button type="button" class="btn application__titlebar__btn application__titlebar__btn--minimise"><div></div></button>
                <button 
                    type="button" 
                    :class="[
                        'btn',
                        'application__titlebar__btn',
                        'application__titlebar__btn--maximise',
                        maxDisabled ? 'application__titlebar__btn--disabled' : '',
                    ]" 
                    @click="maximise"
                >
                    <div></div>
                </button>
                <button type="button" class="btn application__titlebar__btn application__titlebar__btn--close" @click="$emit('close')"><div></div><div></div></button>
            </div>
        </div>

        <div class="application__main">
            <slot />
        </div>
    </div>
</template>
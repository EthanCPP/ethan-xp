<script setup>
import { onMounted, ref } from 'vue';
import Icons from '../../Util/Icons';
import Application from '../Application.vue';
import Api from '../../Util/Api';
import axios from 'axios';

const emit = defineEmits(['startApplication']);
const props = defineProps(['target', 'other']);

const subject = ref('');
const message = ref('');
const from = ref('');
const name = ref('');
const messageSent = ref(false);
const sendingMessage = ref(false);
const csrfToken = ref(null);

let api;

onMounted(() => {
    api = new Api();

    getCsrfToken();
});

async function getCsrfToken() {
    const response = await api.getCsrfToken();

    if (response?.token) {
        csrfToken.value = response.token;
    }
}

async function sendEmail() {
    if (! subject.value.length) {
        emit('startApplication', 'error', '', {other: 'Please enter a subject'});
        return;
    }

    if (! message.value.length) {
        emit('startApplication', 'error', '', {other: 'Please enter a message'});
        return;
    }

    if (! from.value.length) {
        emit('startApplication', 'error', '', {other: 'Please enter your email address'});
        return;
    }

    if (! name.value.length) {
        emit('startApplication', 'error', '', {other: 'Please enter your name'});
        return;
    }

    if (messageSent.value) {
        emit('startApplication', 'error', '', {other: 'You already sent a message'});
        return;
    }

    sendingMessage.value = true;

    const response = await api.sendEmail({
        token: csrfToken.value,
        subject: subject.value,
        message: message.value,
        from: from.value,
        name: name.value,
    });

    sendingMessage.value = false;

    if (response?.success) {
        messageSent.value = true;
        emit('startApplication', 'info', '', {other: 'Your message has been sent!'});
    } else {
        emit('startApplication', 'error', '', {other: response.message});
    }
}
</script>

<template>
    <Application :icon="Icons.outlook" title="New Message" width="540" height="460">
        <div class="outlook">
            <div class="outlook__toolbar">
                <button type="button" class="btn outlook__toolbar__btn">File</button>
                <button type="button" class="btn outlook__toolbar__btn">Edit</button>
                <button type="button" class="btn outlook__toolbar__btn">View</button>
                <button type="button" class="btn outlook__toolbar__btn">Insert</button>
                <button type="button" class="btn outlook__toolbar__btn">Format</button>
                <button type="button" class="btn outlook__toolbar__btn">Tools</button>
                <button type="button" class="btn outlook__toolbar__btn">Message</button>
                <button type="button" class="btn outlook__toolbar__btn">Help</button>

                <div class="outlook__toolbar__windows">
                    <img :src="Icons.windows" />
                </div>
            </div>

            <div class="outlook__actionbar">
                <button @click="sendEmail" type="button" class="btn outlook__actionbar__btn">
                    <img :src="Icons.emailSend" />
                    <span>Send</span>
                </button>
                <button type="button" class="btn disabled outlook__actionbar__btn">
                    <img :src="Icons.cut" />
                    <span>Cut</span>
                </button>
                <button type="button" class="btn disabled outlook__actionbar__btn">
                    <img :src="Icons.copy" />
                    <span>Copy</span>
                </button>
                <button type="button" class="btn disabled outlook__actionbar__btn">
                    <img :src="Icons.paste" />
                    <span>Paste</span>
                </button>
                <button type="button" class="btn disabled outlook__actionbar__btn">
                    <img :src="Icons.undo" />
                    <span>Undo</span>
                </button>
            </div>

            <div class="outlook__content">
                <div class="outlook__field">
                    <div class="outlook__field-label">
                        <img :src="Icons.emailTo" /> To:
                    </div>

                    <input type="text" disabled class="form-control outlook__field-input" value="ethan@emailhidden.com" />
                </div>

                <div class="outlook__field">
                    <div class="outlook__field-label">Email:</div>

                    <input type="text" class="form-control outlook__field-input" v-model="from" placeholder="you@example.com" />
                </div>

                <div class="outlook__field">
                    <div class="outlook__field-label">Name:</div>

                    <input type="text" class="form-control outlook__field-input" v-model="name" placeholder="John Doe" />
                </div>

                <div class="outlook__field">
                    <div class="outlook__field-label">Subject:</div>

                    <input type="text" class="form-control outlook__field-input" v-model="subject" />
                </div>

                <textarea class="form-control outlook__field-textarea" placeholder="Please type your message here.." v-model="message"></textarea>
            </div>
        </div>
    </Application>
</template>
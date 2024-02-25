<script setup>
import { onMounted, ref } from 'vue';
import Application from '../Application.vue';
import Icons from '../../Util/Icons';
import RecycleBin from './ExplorerLocations/RecycleBin.vue';
import SomeProject from './ExplorerLocations/SomeProject.vue';
import InternetExplorer from './ExplorerLocations/InternetExplorer.vue';

const emit = defineEmits(['startApplication']);
const props = defineProps(['target', 'other']);

const data = ref({location: null, component: null, address: null, icon: null, title: null});

function getData() {
    switch(data.value.location) {
        case 'recycle-bin':
            data.value.icon = Icons.binEmpty;
            data.value.address = 'Recycle Bin';
            data.value.title = 'Recycle Bin';
            data.value.component = RecycleBin;
            break;
        case 'some-project':
            data.value.icon = Icons.folder;
            data.value.address = 'C:\\Documents and Settings\\Ethan\\My Documents\\Some project';
            data.value.title = 'Some project';
            data.value.component = SomeProject;
            break;
        case 'internet-explorer':
            data.value.icon = Icons.ie;
            data.value.title = 'Internet Explorer';
            data.value.component = InternetExplorer;
            break;
        default:
            data.value.icon = Icons.folder;
            data.value.title = 'Unknown';
            break;
    }
}

onMounted(() => {
    data.value.location = props.target;

    if (props.other?.url) {
        data.value.address = props.other.url;
    }

    getData();
});

function startApplication(application, target = '', other = '') {
    emit('startApplication', application, target, other);
}
</script>

<template>
    <Application :icon="data.icon" :title="data.title">
        <div class="file-explorer">
            <div class="file-explorer__toolbar">
                <button type="button" class="btn file-explorer__toolbar__btn">File</button>
                <button type="button" class="btn file-explorer__toolbar__btn">Edit</button>
                <button type="button" class="btn file-explorer__toolbar__btn">View</button>
                <button type="button" class="btn file-explorer__toolbar__btn">Favorites</button>
                <button type="button" class="btn file-explorer__toolbar__btn">Tools</button>
                <button type="button" class="btn file-explorer__toolbar__btn">Help</button>

                <div class="file-explorer__toolbar__windows">
                    <img :src="Icons.windows" />
                </div>
            </div>

            <div class="file-explorer__navigator">
                <button type="button" class="btn file-explorer__navigator__btn file-explorer__navigator__btn--back">
                    <img :src="Icons.fileBack" />
                    <span>Back</span>
                </button>
                <button type="button" class="btn file-explorer__navigator__btn file-explorer__navigator__btn--forward">
                    <img :src="Icons.fileBack" />
                </button>
                <button type="button" class="btn file-explorer__navigator__btn file-explorer__navigator__btn--up">
                    <img :src="Icons.folderUp" />
                </button>
                <button type="button" class="btn file-explorer__navigator__btn file-explorer__navigator__btn--search">
                    <img :src="Icons.search" />
                    <span>Search</span>
                </button>
                <button type="button" class="btn file-explorer__navigator__btn file-explorer__navigator__btn--folders">
                    <img :src="Icons.folder" />
                    <span>Folders</span>
                </button>
            </div>

            <div class="file-explorer__address-bar">
                <span class="file-explorer__address-bar__title">Address</span>
                <div class="file-explorer__address-bar__element">{{ data.address }}</div>
                <button type="button" class="btn file-explorer__address-bar__go">
                    <img :src="Icons.navNext" />
                    <span>Go</span>
                </button>
            </div>
        </div>


        <component
            v-if="data.component"
            :is="data.component"
            :address="data.address"
            @close="closeApplication(index)"
            @startApplication="startApplication"
        />
    </Application>
</template>
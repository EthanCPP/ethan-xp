<script setup>
import { onMounted, ref } from 'vue';
import Application from '../Application.vue';
import Icons from '../../Util/Icons';
import RecycleBin from './ExplorerLocations/RecycleBin.vue';
import SomeProject from './ExplorerLocations/SomeProject.vue';
import InternetExplorer from './ExplorerLocations/InternetExplorer.vue';
import GenericFile from './ExplorerLocations/GenericFile.vue';

const emit = defineEmits(['startApplication']);
const props = defineProps(['target', 'other']);

const data = ref({location: null, component: null, address: null, icon: null, title: null, other: null});

function getData() {
    data.value.icon = props.other?.icon ? Icons[props.other.icon] : Icons.folder;
    data.value.title = props.other?.name ? props.other.name : 'Unknown';

    switch(data.value.location) {
        case 'internet-explorer':
            data.value.component = InternetExplorer;
            data.value.address = props.other.other;
            break;
        case 'generic-file':
            data.value.component = GenericFile;
            data.value.other = props.other;
            break;
        default:
            break;
    }
}

onMounted(() => {
    data.value.location = props.target;

    if (props.other?.target) {
        data.value.location = props.other.target;
    }

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
            :other="data.other"
            @close="closeApplication(index)"
            @startApplication="startApplication"
        />
    </Application>
</template>
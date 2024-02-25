<script setup>
import Icons from '../Util/Icons';

const props = defineProps(['address']);
</script>

<template>
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
            <div class="file-explorer__address-bar__element">{{ address }}</div>
            <button type="button" class="btn file-explorer__address-bar__go">
                <img :src="Icons.navNext" />
                <span>Go</span>
            </button>
        </div>

        <slot />
    </div>
</template>
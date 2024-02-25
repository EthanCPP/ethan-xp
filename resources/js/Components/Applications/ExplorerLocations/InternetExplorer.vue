<script setup>
const props = defineProps(['address']);
</script>

<template>
    <iframe :src="address" style="width: 100%; height: 100%;"></iframe>
</template>
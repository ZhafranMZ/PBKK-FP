<script setup>
    import { Link, usePage } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import PostOverlay from '@/Components/PostOverlay.vue';

    import UpdatePhotoOverlay from '@/Components/UpdatePhotoOverlay.vue';

    const user = usePage().props.auth.user;

    let showPhotoUpdate = ref(false);
    console.log(user.file);
</script>

<template>
    <div class="flex flex-col items-center">
        <img class="rounded-full w-[6rem] h-[6rem] -mt-[1px]" :src="user.file">
        <button @click="showPhotoUpdate=true" class="mt-2 text-blue-500 hover:text-gray-900 text-base font-extrabold">Switch</button>
    </div>
    <UpdatePhotoOverlay v-if="showPhotoUpdate" @close="$event => showPhotoUpdate = false"/>
</template>
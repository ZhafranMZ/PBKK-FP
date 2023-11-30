<script setup>
import { computed, toRefs, ref, onMounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';

import Heart from 'vue-material-design-icons/Heart.vue';
import HeartOutline from 'vue-material-design-icons/HeartOutline.vue';
import CommentOutline from 'vue-material-design-icons/CommentOutline.vue';
import SendOutline from 'vue-material-design-icons/SendOutline.vue';
import BookmarkOutline from 'vue-material-design-icons/BookmarkOutline.vue';
import axios from 'axios';

const props = defineProps(['user_id'])
const { user_id } = toRefs(props)

let isFollowing = ref(false)
let id = ref(0);

console.log(user_id.value);

const getData = async () => {
    try {
    const response = await axios.get('/follow/'+ user_id.value);
    
    console.log(response);
    isFollowing.value = response.data.check;
    id = user_id.value;
    } catch (error) {
    console.error('Error fetching data:', error);
    }
};

onMounted(getData);

const toFollow = (id) => {
    console.log(id);
    router.post('/follow/' + id, {
        onSuccess: () => {
                location.reload();
            }
    });
}

const toUnfollow = (id) => {
    router.delete('/follow/' + id, {
        onSuccess: () => {
                location.reload();
            }
    });
}

console.log(isFollowing);
</script>

<template>
    <div class="flex z-20 items-center justify-between">
        <button v-if="!isFollowing" @click=" toFollow(id)" class="md:block hidden md:mr-6 p-1 px-4 rounded-lg text-[16px] text-white font-extrabold bg-blue-600 hover:bg-blue-700">
            Follow
        </button>
        <button v-if="isFollowing" @click="toUnfollow(id)" class="md:block hidden md:mr-6 p-1 px-4 rounded-lg text-[16px] font-extrabold bg-gray-100 hover:bg-gray-200">
            Following
        </button>
    </div>
</template>
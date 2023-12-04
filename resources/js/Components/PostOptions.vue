<script setup>
import { toRefs } from 'vue'

defineEmits(['close', 'deleteSelected', 'edit'])
// const proppost = defineProps(['post'])
const props = defineProps({ editContent:{type:String, default:''}, type: String, id: Number, userId: String, post: Object, comment: Object})

const { editContent, type, id, post, userId, comment } = toRefs(props)

console.log(comment);
</script>

<template>
    <div
        id="PostOptions"
        class="fixed flex items-center z-50 top-0 left-0 w-full h-screen bg-[#000000] bg-opacity-60 p-3"
    >
        <div class="max-w-sm w-full mx-auto mt-10 bg-white rounded-xl text-center">
            <button
                @click="$emit('deleteSelected', { type, id });"
                class="font-extrabold w-full text-red-600 p-3 text-lg border-b border-b-gray-300 cursor-pointer"
            >
                Delete {{ type }}
            </button>
            <button
                v-if="type === 'Post' && post.user.id === userId || type === 'Comment' && comment.user.id === userId"
                @click="$emit('edit', {type, editContent}); $emit('close')"
                class="font-extrabold w-full p-3 text-lg border-b border-b-gray-300 cursor-pointer"
            >
                Edit {{ type }}
            </button>
            <div class="p-3 text-lg cursor-pointer" @click="$emit('close')">Cancel</div>
        </div>
    </div>
</template>
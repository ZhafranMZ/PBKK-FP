<script setup>

import { ref, toRefs } from 'vue'
import { usePage } from '@inertiajs/vue3'

import PostOptions from '@/Components/PostOptions.vue'
import InteractionSection from '@/Components/InteractionSection.vue'

import Close from 'vue-material-design-icons/Close.vue';
import DotsHorizontal from 'vue-material-design-icons/DotsHorizontal.vue';
import EmoticonHappyOutline from 'vue-material-design-icons/EmoticonHappyOutline.vue';

let comment = ref('')
let editId = ref(0)
let type = ref(null)
let id = ref(null)
let edit = ref('')
let editContent = ref('')

const user = usePage().props.auth.user

const props = defineProps(['post'])
const { post } = toRefs(props)

defineEmits(['closeOverlay', 'addComment', 'updateLike', 'deleteSelected', 'updateSelected', 'edit', 'updateSaved'])

const textareaInput = (e) => {
    textarea.value.style.height = "auto";
    textarea.value.style.height = `${e.target.scrollHeight}px`;
}
</script>

<template>
    <div id="OverlaySection" class="fixed z-50 top-0 left-0 w-full h-screen bg-[#000000] bg-opacity-60 p-3">

        <button class="absolute right-3" @click="$emit('closeOverlay')">
            <Close :size="27" fillColor="#FFFFFF"/>
        </button>

        <div class="max-w-6xl h-[calc(100%-100px)] mx-auto mt-10 bg-white rounded-xl">
            <div class="w-full md:flex h-full overflow-auto rounded-xl">
                <div class="flex items-center bg-black w-full">
                    <img
                        class="rounded-xl min-w-[400px] p-4 mx-auto"
                        :src="post.file"
                    >
                </div>

                <div class="md:max-w-[500px] w-full relative">
                    <div class="flex items-center justify-between p-3 border-b">
                        <div class="flex items-center">
                            <img class="rounded-full w-[38px] h-[38px]" :src="post.user.file">
                            <div class="ml-4 font-extrabold text-[15px]">{{ post.user.name }}</div>
                            <div class="flex items-center text-[15px] text-gray-500">
                                <span class="-mt-5 ml-2 mr-[5px] text-[35px]">.</span>
                                <div>{{ post.created_at }}</div>
                            </div>
                        </div>
                        <button
                            v-if="user.id === post.user.id"
                            @click="type = 'Post'; editId = post.id; id = post.id;"
                        >
                            <DotsHorizontal class="cursor-pointer" :size="27" />
                        </button>
                    </div>

                    <div class="overflow-y-auto h-[calc(100%-170px)]">
                        <div class="flex items-center justify-between p-3">
                            <div class="flex items-center relative">
                                <img
                                    class=" absolute -top-1 rounded-full w-[38px] h-[38px]"
                                    :src="post.user.file"
                                >
                                <div class="ml-14">
                                    <span class="font-extrabold text-[15px] mr-2">
                                        {{ post.user.name }}
                                    </span>
                                    <span v-show="edit !== 'Post'" class="text-[15px] text-gray-900">
                                        {{ post.text }}
                                    </span>
                                    <div class=" flex items-center">
                                    <textarea v-show="edit === 'Post' && editId === post.id" v-model="post.text" 
                                    class="max-w-[80%]  
                                        border-0
                                        mt-2
                                        mb-2
                                        text-sm
                                        z-50
                                        focus:ring-0
                                        text-gray-600
                                        text-[18px]"
                                        rows="1" cols="55"
                                    >{{ post.text }}</textarea>
                                    <button
                                        v-show="edit === 'Post' && editId === post.id"
                                        class="min-w-[20%] text-blue-600 font-extrabold pr-4"
                                        @click="
                                        editContent=post.text;
                                        type='Post'
                                        id=post.id; 
                                        $emit('updateSelected', {editContent, type, id, post});
                                        editContent= '';
                                        type='';
                                        edit='';
                                        editId=''"
                                    >
                                        Edit
                                    </button>
                            </div>
                                </div>
                            </div>
                        </div>

                        <div
                            v-if="post.comments"
                            class="p-3"
                            v-for="comment in post.comments"
                            :key="comment"
                        >
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img
                                        class="rounded-full w-[38px] h-[38px]"
                                        :src="comment.user.file"
                                    >
                                    <div class="ml-4 font-extrabold text-base">
                                        {{ comment.user.name }}
                                        <span class="font-light text-gray-700 text-xs">{{ post.created_at }}</span>
                                    </div>
                                </div>

                                <DotsHorizontal
                                    v-if="user.id === comment.user.id && !edit || !edit === 'Comment' && editId !== comment.id"
                                    class="cursor-pointer"
                                    @click="editId=comment.id; editContent=comment.comment; type = 'Comment'; id = comment.id"
                                    :size="27"
                                />
                            </div>

                            <div v-if="editId !== comment.id || edit !== 'Comment'" class="text-sm pl-[55px]">
                                {{ comment.comment }}
                            </div>
                            
                            <div class=" flex items-center">
                                <textarea v-show="edit === 'Comment' && editId === comment.id" v-model="comment.comment" 
                                class="max-w-[80%] 
                                    border-0
                                    mt-2
                                    mb-2
                                    text-sm
                                    z-50
                                    focus:ring-0
                                    text-gray-600
                                    text-[18px]"
                                    rows="1" cols="55"
                                >{{ comment.comment }}</textarea>
                                <button
                                    v-show="edit === 'Comment' && editId === comment.id"
                                    class="min-w-[20%] text-blue-600 font-extrabold pr-4"
                                    @click="
                                    editContent=comment.comment;
                                    type='Comment'
                                    id=comment.id; 
                                    $emit('updateSelected', {editContent, type, id, post});
                                    editContent= '';
                                    type='';
                                    edit='';
                                    editId=''"
                                >
                                    Edit
                                </button>
                            </div>
                            
                        </div>

                        <div class="pb-16 md:hidden"></div>
                    </div>

                    <InteractionSection
                        v-if="post"
                        class="px-2 border-t mb-2"
                        :post="post"
                        @like="$emit('updateLike', $event)"
                        @saved="$emit('updateSaved', $event)"
                    />

                    <div class="absolute flex border bottom-0 w-full max-h-[200px] bg-white overflow-auto">
                        <EmoticonHappyOutline class="pl-3 pt-[10px]" :size="30" />
                        <textarea
                            ref="textarea"
                            :oninput="textareaInput"
                            v-model="comment"
                            placeholder="Add a comment..."
                            rows="1"
                            class="
                                w-full
                                border-0
                                mt-2
                                mb-2
                                text-sm
                                z-50
                                focus:ring-0
                                text-gray-600
                                text-[18px]
                            "
                        ></textarea>
                        <button
                            v-if="comment"
                            class="text-blue-600 font-extrabold pr-4"
                            @click="
                                $emit('addComment', { post, user, comment });
                                comment = ''
                            "
                        >
                            Post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <PostOptions
        v-if="type"
        :type="type"
        :id="id"
        :editContent="editContent"
        :userId="user.id"
        :post="post"
        @deleteSelected="
            $emit('deleteSelected', {
                type: $event.type,
                id: $event.id,
                post: post,
            })
            type = null;
            id = null;
        "
        @edit="
            edit = $event.type,
            comment = $event.editContent
        "

        @close="type = null; id = null"
    />
</template>
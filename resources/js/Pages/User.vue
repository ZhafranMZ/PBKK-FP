<script setup>
import { reactive, toRefs } from 'vue'
import { Head, Link, router, usePage } from '@inertiajs/vue3';

import Layout from '@/Layouts/Layout.vue';
import PostDetailOverlay from '@/Components/PostDetailOverlay.vue'
import UserContent from '@/Components/UserContent.vue'


import Cog from 'vue-material-design-icons/Cog.vue';
import Grid from 'vue-material-design-icons/Grid.vue';
import PlayBoxOutline from 'vue-material-design-icons/PlayBoxOutline.vue';
import BookmarkOutline from 'vue-material-design-icons/BookmarkOutline.vue';
import AccountBoxOutline from 'vue-material-design-icons/AccountBoxOutline.vue';

let data = reactive({ post: null })
const form = reactive({ file: null })

const props = defineProps({ postsByUser: Object, user: Object, follow: Boolean })
const { postsByUser, user, follow } = toRefs(props)

const addComment = (object) => {
    router.post('/comments', {
        post_id: object.post.id,
        user_id: object.user.id,
        comment: object.comment
    }, {
        onFinish: () => updatedPost(object),
    }
    )
}

const deleteFunc = (object) => {
    let url = ''
    if (object.deleteType === 'Post') {
        url = '/posts/' + object.id
        setTimeout(() => data.post = null, 100)
    } else {
        url = '/comments/' + object.id
    }

    router.delete(url, {
        onFinish: () => updatedPost(object),
    })
}

const updateLike = (object) => {
    let deleteLike = false
    let id = null

    for (let i = 0; i < object.post.likes.length; i++) {
        const like = object.post.likes[i];
        if (like.user_id === object.user.id && like.post_id === object.post.id) {
            deleteLike = true
            id = like.id
        }
    }

    if (deleteLike) {
        router.delete('/likes/' + id, {
            onFinish: () => updatedPost(object),
        })
    } else {
        router.post('/likes', {
            post_id: object.post.id,
        },{
            onFinish: () => updatedPost(object),
        })
    }
}

const updateFunc = (object) => {
        console.log("update");
        console.log(object);
        let url = ''
        if (object.type === 'Post') {
            url = '/posts/' + object.id
        } else {
            url = '/comments/' + object.id
        }

        if (object.type === 'Comment'){
            console.log(url);
            router.patch(url, {
                // method: 'post',
                // forceFormData: true,
                // headers: { 'Content-Type': 'multipart/form-data' },
                // data: {
                comment: object.editContent
            }, {
                onError:() => alert(response.message),
                onFinish: () => updatedPost(object),
            })
        }else {
            router.patch(url, {
                comment: object.editContent
            }, {
                onError:() => alert(response.message),
                onFinish: () => updatedPost(object),
            })
        }
        

        if (object.type === 'Post') {
            openOverlay.value = false
        }
    }

const updatedPost = (object) => {
    for (let i = 0; i < postsByUser.value.data.length; i++) {
        const post = postsByUser.value.data[i];
        if (post.id === object.post.id) {
            data.post = post
        }
    }
}

const getUploadedImage = (e) => {
    form.file = e.target.files[0]
    router.post(`/users`, form, {
        preserveState: false
    })
}

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

</script>

<template>
    <Head title="Echo" />

    <Layout>
        <div class="pt-2 md:pt-6"></div>
        <div class="max-w-[880px] lg:ml-0 md:ml-[80px] md:pl-20 px-4 w-[100vw]">
            <div class="flex items-center md:justify-between">

                <label for="fileUser">
                    <img
                        class="rounded-full object-fit md:w-[200px] w-[100px] cursor-pointer"
                        :src="user.file"
                    >
                </label>
                <input
                    v-if="user.id === $page.props.auth.user.id"
                    id="fileUser"
                    class="hidden"
                    type="file"
                    @input="getUploadedImage($event)"
                >

                <div class="ml-6 w-full">
                    <div  class="flex items-center md:mb-8 mb-5">
                        <div class="md:mr-6 mr-3 rounded-lg text-[22px] font-semibold">{{ user.name }}</div>
                        <Link v-if="$page.props.auth.user.id === user.id" :href="route('profile.edit')" class="md:block hidden md:mr-6 p-1 px-4 rounded-lg text-[16px] font-extrabold bg-gray-100 hover:bg-gray-200">
                            Edit Profile 
                        </Link>
                        <button v-if="$page.props.auth.user.id !== user.id && follow === false" @click="toFollow(user.id)" class="md:block hidden md:mr-6 p-1 px-4 rounded-lg text-[16px] text-white font-extrabold bg-blue-600 hover:bg-blue-700">
                            Follow
                        </button>
                        <button v-if="$page.props.auth.user.id !== user.id && follow === true" @click="toUnfollow(user.id)" class="md:block hidden md:mr-6 p-1 px-4 rounded-lg text-[16px] font-extrabold bg-gray-100 hover:bg-gray-200">
                            Following
                        </button>
                    </div>
                    <Link v-if="$page.props.auth.user.id === user.id" :href="route('profile.edit')" class="md:hidden mr-6 p-1 px-4 max-w-[260px] w-full rounded-lg text-[17px] font-extrabold bg-gray-100 hover:bg-gray-200">
                        Edit Profile
                    </Link>
                    <button v-if="$page.props.auth.user.id !== user.id && follow === false" @click="toFollow(user.id)" class="md:hidden md:mr-6 p-1 px-4 rounded-lg text-[16px] text-white font-extrabold bg-blue-600 hover:bg-blue-700">
                        Follow
                    </button>
                    <button v-if="$page.props.auth.user.id !== user.id && follow === true" @click="toUnfollow(user.id)" class="md:hidden md:mr-6 p-1 px-4 rounded-lg text-[16px]font-extrabold bg-gray-100 hover:bg-gray-200">
                        Following
                    </button>
                    <div class="md:block hidden">
                        <div class="flex items-center text-[18px]">
                            <div class="mr-6">
                                <span class="font-extrabold">{{ postsByUser.data.length }}</span>  posts
                            </div>
                            <div class="mr-6">
                                <span class="font-extrabold">123</span>  followers
                            </div>
                            <div class="mr-6">
                                <span class="font-extrabold">456</span>  following
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="md:hidden">
            <div class="w-full flex items-center justify-around border-t border-t-gray-300 mt-8">
                <div class="text-center p-3">
                    <div class="font-extrabold">{{ postsByUser.data.length }}</div>
                    <div class="text-gray-400 font-semibold -mt-1.5">posts</div>
                </div>
                <div class="text-center p-3">
                    <div class="font-extrabold">43</div>
                    <div class="text-gray-400 font-semibold -mt-1.5">followers</div>
                </div>
                <div class="text-center p-3">
                    <div class="font-extrabold">55</div>
                    <div class="text-gray-400 font-semibold -mt-1.5">following</div>
                </div>
            </div>

            <div class="w-full flex items-center justify-between border-t border-t-gray-300">
                <div class="p-3 w-1/4 flex justify-center border-t border-t-gray-900">
                    <Grid :size="28" fillColor="#0095F6" class="cursor-pointer"/>
                </div>
                <div class="p-3 w-1/4 flex justify-center">
                    <PlayBoxOutline :size="28" fillColor="#8E8E8E" class="cursor-pointer"/>
                </div>
                <div class="p-3 w-1/4 flex justify-center">
                    <BookmarkOutline :size="28" fillColor="#8E8E8E" class="cursor-pointer"/>
                </div>
                <div class="p-3 w-1/4 flex justify-center">
                    <AccountBoxOutline :size="28" fillColor="#8E8E8E" class="cursor-pointer"/>
                </div>
            </div>
        </div>

        <div id="ContentSection" class="md:pr-1.5 lg:pl-0 md:pl-[90px]">
            <div class="md:block mt-10 hidden border-t border-t-gray-300">
                <div class="flex items-center justify-between max-w-[600px] mx-auto font-extrabold text-gray-400 text-[15px]">
                    <div class="p-[17px] w-1/4 flex justify-center items-center border-t border-t-gray-900">
                        <Grid :size="15" fillColor="#000000" class="cursor-pointer"/>
                        <div class="ml-2 -mb-[1px] text-gray-900">POSTS</div>
                    </div>
                    <div class="p-[17px] w-1/4 flex justify-center items-center">
                        <PlayBoxOutline :size="15" fillColor="#8E8E8E" class="cursor-pointer"/>
                        <div class="ml-2 -mb-[1px] text-gray-900">REELS</div>
                    </div>
                    <div class="p-[17px] w-1/4 flex justify-center items-center">
                        <BookmarkOutline :size="15" fillColor="#8E8E8E" class="cursor-pointer"/>
                        <span class="ml-2 -mb-[1px]">SAVED</span>
                    </div>
                    <div class="p-[17px] w-1/4 flex justify-center items-center">
                        <AccountBoxOutline :size="15" fillColor="#8E8E8E" class="cursor-pointer"/>
                        <span class="ml-2 -mb-[1px]">TAGGED</span>
                    </div>
                </div>
            </div>

            <div class="grid md:gap-4 gap-1 grid-cols-3 relative">
                <div v-for="postByUser in postsByUser.data" :key="postByUser">
                    <UserContent
                        :postByUser="postByUser"
                        @selectedPost="data.post = $event"
                    />
                </div>
            </div>

            <div class="pb-20"></div>
        </div>
    </Layout>

    <PostDetailOverlay
        v-if="data.post"
        :post="data.post"
        @addComment="addComment($event)"
        @updateLike="updateLike($event)"
        @deleteSelected="
            deleteFunc($event);
        "
        @updateSelected = "updateFunc($event)"
        @closeOverlay="data.post = null"
    />
</template>



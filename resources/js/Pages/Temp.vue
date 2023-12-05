<script setup>
    import { ref, onMounted, toRefs } from 'vue'
    import { Head, Link, router } from '@inertiajs/vue3'
    import { useRouter } from 'vue-router'
    import Layout from '@/Layouts/Layout.vue'
    import InteractionSection from '@/Components/InteractionSection.vue'
    import PostDetailOverlay from '@/Components/PostDetailOverlay.vue'
    import PostOverlay from '@/Components/PostOverlay.vue'
    import 'vue3-carousel/dist/carousel.css'
    import { Carousel, Slide, Navigation } from 'vue3-carousel'

    import DotsHorizontal from 'vue-material-design-icons/DotsHorizontal.vue'

    let wWidth = ref(window.innerWidth)
    let currentSlide = ref(0)
    let currentPost = ref(null)
    let openOverlay = ref(false)
    let showCreatePost = ref(false)

    const props = defineProps({ posts: Object, allUsers: Object })
    const { posts, allUsers } = toRefs(props)

    onMounted(() => {
        window.addEventListener('resize', () => {
            wWidth.value = window.innerWidth
        })
    })

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
        console.log(object);
        if (object.type === 'Post') {
            url = '/posts/' + object.id
        } else {
            url = '/comments/' + object.id
        }

        router.delete(url, {
            onFinish: () => updatedPost(object),
        })

        if (object.type === 'Post') {
            openOverlay.value = false
        }
    }

//     {
//     method: 'PATCH',
//     headers: { 'Content-Type': 'application/json' },
//     body: JSON.stringify({ name: 'Vue 3 PATCH Request Example' })
// }
    const updateFunc = (object) => {
        console.log("update");
        console.log(object);
        let url = ''
        if (object.type === 'Post') {
            url = '/posts/' + object.id
        } else {
            url = '/comments/' + object.id
        }
        console.log(object);
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
                text: object.editContent
            }, {
                onError:() => alert(response.message),
                onFinish: () => updatedPost(object),
            })
        }
        

        if (object.type === 'Post') {
            openOverlay.value = false
        }
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
            router.post('/store_like', {
                post_id: object.post.id,
            },{
                onFinish: () => updatedPost(object),
            })
        }
    }

    const updateSaved = (object) => {
        let deleteSaved = false
        let id = null

        for (let i = 0; i < object.post.saveds.length; i++) {
            const saved = object.post.saveds[i];
            if (saved.user_id === object.user.id && saved.post_id === object.post.id) {
                deleteSaved = true
                id = saved.id
            }
        }

        if (deleteSaved) {
            router.delete('/saveds/' + id, {
                onFinish: () => updatedPost(object),
            })
        } else {
            router.post('/saveds', {
                post_id: object.post.id,
            },{
                onFinish: () => updatedPost(object),
            })
        }
    }

    const updatedPost = (object) => {
        for (let i = 0; i < posts.value.data.length; i++) {
            const post = posts.value.data[i];
            console.log(post);
            if (post.id === object.post.id) {
                currentPost.value = post
            }
        }
    }
</script>

<template>
    <Head title="Home" />
    <Layout>
        <div class="mx-auto lg:pl-0 md:pl-[80px] pl-0">
            <div class="w-full flex justify-center relative mt-3">
                <div class="animate-ping top-[15%] absolute z-0 inline-flex h-3/4 w-[31%] rounded-full bg-sky-800 opacity-75" />
                <button @click="showCreatePost = true" class=" text-lg z-30 bg-blue-700 rounded-xl py-3 px-10 text-white font-medium">
                    Ready to <span class=" font-black">ECHO</span> your mind ?
                </button>
            </div>
            <div id="Posts" class="px-4 max-w-[600px] mx-auto mt-10" v-for="post in posts.data" :key="post">
                <div class="flex items-center justify-between py-2">
                    <div class="flex items-center">
                        <Link :href="route('users.show', { id: post.user.id })" class="flex items-center">
                            <img class="rounded-full w-[38px] h-[38px]" :src="post.user.file">
                            <div class="ml-4 font-extrabold text-[15px]">{{ post.user.name }}</div>
                        </Link>
                        <div class="flex items-center text-[15px] text-gray-500">
                            <span class="-mt-5 ml-2 mr-[5px] text-[35px]">.</span>
                            <div>{{ post.created_at }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-black rounded-lg w-full min-h-[400px] flex items-center">
                    <img class="mx-auto w-full" :src="post.file" />
                </div>

                <InteractionSection
                    :post="post"
                    @like="updateLike($event)"
                    @saved="updateSaved($event)"
                />

                <div class="flex z-20 items-center justify-between">
                    <div class="flex items-center">
                        <div class="text-black font-extrabold py-1 mr-4">{{ post.likes.length }} likes</div>
                        <div class="text-black font-extrabold py-1">{{ post.saveds.length }} saved</div>
                    </div>
                </div>

                <div>
                    <span class="text-black font-extrabold">{{ post.user.name }}</span>
                    {{ post.text }}
                </div>
                <button
                    @click="currentPost = post; openOverlay = true"
                    class="text-gray-500 font-extrabold py-1"
                >
                    View all {{ post.comments.length }} comments
                </button>
            </div>

            <div class="pb-20"></div>
        </div>
    </Layout>

    <PostDetailOverlay
        v-if="openOverlay"
        :post="currentPost"
        @addComment="addComment($event)"
        @updateLike="updateLike($event)"
        @updateSaved="updateSaved($event)"
        @deleteSelected="
            deleteFunc($event)
        "
        @updateSelected = "updateFunc($event)"
        @closeOverlay="openOverlay = false"
    />

    <PostOverlay v-if="showCreatePost" @close="showCreatePost = false" />    

</template>

<style>
    .carousel__prev,
    .carousel__next,
    .carousel__prev:hover,
    .carousel__next:hover {
        color: rgb(49, 49, 49);
        background-color: rgb(255, 255, 255);
        border-radius: 100%;
        margin: 0 20px;
    }
</style>

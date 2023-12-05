<script setup>
import { ref, reactive } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import Layout from '@/Layouts/Layout.vue';
import { onMounted,watch } from 'vue';

let user = usePage().props.auth.user;
let message = ref('');
let chat = reactive({
    		message:[],
    	})
function send(message){
    if (message.length != 0) {
        chat.message.push(message);
        router.post('/send', {
            message : message,
            })
            // .then(response => {
            // console.log(response);
            // message = ''
            // })
            // .catch(error => {
            // console.log(error);
            // });
    }
    console.log(chat)
}

watch(
    Echo.private('chat')
        .whisper('typing', {
            name: message
        })
)

onMounted(()=>{
    Echo.private('chat').listen('ChatMade', (e) => {console.log(e);});
    Echo.join(`chat`)
    	        .here((user) => {
    	        })
    	        .joining((user) => {
                    alert('Welcome ' + user.name);
    	        })
    	        .leaving((user) => {
    	        })
            }
)

</script>
<template>
    <Head title="Chat" />
    <Layout>
        <div class="fixed flex h-[90%] border-gray-100 border-2 w-[53%] border-r border-r-gray-300">
            <div class="border-r-2 border-gray-100 font-bold text-xl text-center mt-5 text-black w-[25%] space-y-2">
                <div>
                    Who to echo ?
                </div>

            </div>
            <div class="w-[75%] h-full bg-white">
                <div class=" max-h-[91%] overflow-y-auto space-y-3">
                    <div v-for="msg in chat.message" :key="msg" class="text-black">{{ msg }}</div>
                </div>
                <input
                    v-model="message"
                    type="text"
                    placeholder="Send Your Text"
                    class="
                        fixed
                        bottom-[7%]
                        bg-transparent
                        w-[39%]
                        placeholder-[#8E8E8E]
                        border-0
                        ring-0
                        focus:ring-0
                    "
                    @keyup.enter='send(message)'
                >
            </div>
            <!-- <div v-for="randUser in usersToFollow.data" :key="randUser" >
                <div v-if="$page.props.auth.user.id !== randUser.id" class="flex justify-between">
                    <Link :href="route('users.show', { id: randUser.id })" class="flex items-center justify-between max-w-[300px] pb-2">
                    <div class="flex items-center">
                        <img class="rounded-full z-10 w-[37px] h-[37px]" :src="randUser.file">
                        <div class="pl-4">
                            <div class="text-black font-extrabold">{{ randUser.name }}</div>
                            <div class="text-gray-500 text-extrabold text-sm">Suggested for you</div>
                        </div>
                    </div>
                    </Link>
                    <FollowSection :user_id = "randUser.id" @click="getData()"/>
                </div>
            </div> -->
        </div>
    </Layout>
</template>
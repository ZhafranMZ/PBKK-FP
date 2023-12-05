<script setup>
import { reactive, toRefs, ref } from 'vue'
import { Head, Link, router, usePage } from '@inertiajs/vue3';

import Layout from '@/Layouts/Layout.vue';
import { onMounted } from 'vue';

let data = reactive({ user: null })
const searchs = reactive({ nama: null })

const props = defineProps({ users: Object})
const { users} = toRefs(props)

const query = ref('');
const searchResults = reactive({users: []});
const isSearching = ref(false);

const getData = async () => {
    try {
    const response = await axios.get('/search/'+ query.value);
    
    console.log(response.data);
    searchResults.users = response.data.users;
    console.log("++")
    console.log(searchResults.users);
    id = user_id.value;
    } catch (error) {
    console.error('Error fetching data:', error);
    }
};

onMounted(getData);
// const search = (query) => {
  
//   router.post('/search', { query: query.value });

//     // Update searchResults dengan hasil pencarian dari respons
//   //   searchResults.value = response.data.users;
    
//   // } catch (error) {
//   //   console.error('Error fetching search results:', error);
//   // } finally {
//   //   isSearching.value = false;
//   // }
// };
</script>

<template>
    <div>
        <Head title="Search" />
        <Layout>   
            <div>
                <input v-model="query" @input="searchs" placeholder="Search users with name" @keyup.enter="getData" class="w-[50rem]">
                <ul class="mt-10 space-y-5">
                    <li v-for="user in searchResults.users" :key="user" class="w-[50rem] bg-gray-200 flex p-5">
                        <div class="pl-1">{{ user.name }}</div>
                    </li>
                </ul>
            </div>
        </Layout>
        
    </div>
</template>

<script setup>
    import { router, useForm, usePage } from '@inertiajs/vue3';
    import { ref, reactive, defineEmits } from 'vue';
    import { Inertia } from '@inertiajs/inertia-vue3';

    import PrimaryButton from '@/Components/PrimaryButton.vue';

    import Close from 'vue-material-design-icons/Close.vue';

    const user = usePage().props.auth.user
    const emit = defineEmits(['close'])
    const form = ref({
        file: null,
    })

    let isValidFile = ref(null)
    let fileDisplay = ref('')
    let error = ref({
        file: null,
    })
    const submit = () => {
        error.value.file = null
        const formData = new FormData();
        formData.append('file', form.file);
        // console.log(formData.get('file'));
        router.post('/profile/' + user.id, formData, {
            // method: "patch",
            onError: errors => {
                errors && errors.file ? error.value.file = errors.file : ''
            },
            onSuccess: () => {
                closeOverlay()
                location.reload();
            }
        })
        // console.log(formData);
    }

    const getUploadedImage = (e) => {
        form.file = e.target.files[0]
        let extention = form.file.name.substring(form.file.name.lastIndexOf('.') + 1);

        console.log(extention)

        if (extention == 'png' || extention == 'jpg' || extention == 'jpeg') {
            isValidFile.value = true
        } else {
            isValidFile.value = false
            return
        }
        console.log(form);
        fileDisplay.value = URL.createObjectURL(e.target.files[0])
        // console.log("+");
    }

    const closeOverlay = () => {
        form.file = null
        fileDisplay.value = ''
        emit('close')
    }
</script>

<template>
    <div id="UpdatePhotoOverlay" class="fixed z-50 top-0 left-0 w-full h-screen bg-[#000000] bg-opacity-60 p-3">
        <button class="absolute right-3 cursor-pointer" @click="closeOverlay()">
            <Close :size="27" fillColor="#FFFFFF"/>
        </button>

        <div class="max-w-6xl h-[calc(100%-100px)] mx-auto mt-10 bg-white rounded-xl">
            <div class="flex items-center bg-gray-100 w-full h-full overflow-hidden rounded-l-xl rounded-t-xl">
                <div v-if="!fileDisplay" class="flex flex-col items-center mx-auto rounded-xl">
                    <label
                        for="file"
                        class="hover:bg-blue-700 bg-blue-500 rounded-lg p-2.5 text-white font-extrabold cursor-pointer"
                    >
                        Select From Computer
                    </label>
                    <input
                        id="file"
                        class="hidden"
                        type="file"
                        @input="getUploadedImage($event)"
                    >
                    <div v-if="error && error.file" class="text-red-500 text-center p-2 font-extrabold">{{ error.file }}</div>
                    <div v-if="!fileDisplay && isValidFile === false" class="text-red-500 text-center p-2 font-extrabold">
                        File not accepted
                    </div>
                </div>
                <img v-if="fileDisplay && isValidFile === true" class=" min-w-[400px] p-4 mx-auto" :src="fileDisplay">
            </div>
            <div class="w-full flex flex-row justify-end">
                <!-- <button :disabled="form.processing">Save</button> -->
                <button @click="submit()" class=" rounded-b-xl px-6 py-2 bg-gray-100 text-lg text-blue-500 hover:text-gray-900 font-extrabold">
                    Update
                </button>
            </div>
            
        </div>
    </div>
    
</template>

<!-- @click="createPostFunc()" @submit.prevent="submit"-->
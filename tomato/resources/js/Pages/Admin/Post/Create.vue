<template>
    <div>
        <div class="bg-white p-4 border border-gray-200">
            <div class="text-xs mb-4">
                <Link class="inline-block px-3 py-2 bg-sky-600 border border-sky-700 text-white"
                      :href="route('admin.posts.index')">
                    Back
                </Link>
            </div>
            <div>
                <div class="mb-4">
                    <input v-model="entries.post.title" class="border border-gray-200 p-4 w-full" type="text"
                           placeholder="title">
                </div>
                <div class="mb-4">
                    <textarea v-model="entries.post.body" class="border border-gray-200 p-4 w-full" placeholder="body"/>
                </div>
                <div class="mb-4">
                    <select v-model="entries.post.category_id" class="border border-gray-200 p-4 w-full">
                        <option value="null">Выберите категорию</option>
                        <option v-for="category in categories" :value="category.id"> {{ category.title }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <input ref="files_input" multiple @change="selectFile" class="border border-gray-200 p-4 w-full"
                           type="file">
                </div>
                <div class="mb-4">
                    <input v-model="entries.tags" class="border border-gray-200 p-4 w-full" type="text"
                           placeholder="tags">
                </div>
                <div class="mb-4">
                    <a href="#" @click.prevent="storePost"
                       class="text-xs px-3 py-2 bg-sky-600 border border-sky-700 text-white">STORE</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Create",

    layout: AdminLayout,

    props: {
        // categories: {
        //     type: Array,
        //     required: false
        // }
        categories: Array
    },

    data() {
        return {
            entries: {
                post: {
                    title: '',
                    body: '',
                    category_id: null
                },
                tags:  '',
            }
        }
    },

    components: {
        Link
    },

    methods: {
        storePost() {
            axios.post(route('admin.posts.store'), this.entries, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                }
            })
                .then((res) => {
                    this.$refs.files_input.value = null;
                    this.entries = {
                        post: {
                            title: '',
                            body: '',
                            category_id: null
                        },
                        tags:  '',
                    }
                })//успех
            // .catch(e) ошибка запроса
            //.finally() в любом случае
        },
        selectFile(e) {
            this.entries.images = e.target.files
        }
    }
}
</script>
<style scoped>

</style>

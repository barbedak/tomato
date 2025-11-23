<template>
    <div>
        <div class="bg-white p-4 border border-gray-200">
            <div class="text-xs mb-4">
                <Link class="inline-block px-3 py-2 bg-sky-600 border border-sky-700 text-white"
                      :href="route('admin.posts.index')">
                    Back
                </Link>
            </div>
            <div v-if="isSuccess" class="mb-4 p-4 bg-emerald-500 text-white">
                SUCCESS
            </div>
            <div>
                <div class="mb-4">
                    <input v-model="entries.post.title" class="border border-gray-200 p-4 w-full" type="text"
                           placeholder="title">
                    <div v-if="errors['post.title']" class="text-red-400">
                        <div v-for="error in errors['post.title']">
                            {{ error }}
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <textarea v-model="entries.post.body" class="border border-gray-200 p-4 w-full" placeholder="body"/>
                    <div v-if="errors['post.body']" class="text-red-400">
                        <div v-for="error in errors['post.body']">
                            {{ error }}
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <select v-model="entries.post.category_id" class="border border-gray-200 p-4 w-full">
                        <option value="0">Выберите категорию</option>
                        <option v-for="category in categories" :value="category.id"> {{ category.title }}</option>
                    </select>
                    <div v-if="errors['post.category_id']" class="text-red-400">
                        <div v-for="error in errors['post.category_id']">
                            {{ error }}
                        </div>
                    </div>
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
import {nextTick} from "vue";

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
                    category_id: 0
                },
                tags: '',
            },
            isSuccess: false,
            errors: []
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
                            category_id: 0
                        },
                        tags: '',
                    }
                    this.$nextTick(() => {
                        this.isSuccess = true
                    })
                })//успех
                .catch(e => {
                    this.isSuccess = false
                    this.errors = e.response.data.errors
                })
            //.finally() в любом случае
        },
        selectFile(e) {
            this.entries.images = e.target.files
        }
    },

    watch: {
        entries: {
            handler() {
                this.isSuccess = false
                this.errors = []
            },
            deep: true
        }
    }

}
</script>
<style scoped>

</style>

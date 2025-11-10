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
                    <input v-model="entries.post.title" class="border border-gray-200 p-4 w-full" type="text">
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
                    <input v-model="entries.tags" class="border border-gray-200 p-4 w-full" type="text"
                    placeholder="tags">
                </div>
                <div class="mb-4">
                    <input ref="files_input" multiple @change="selectFile" class="border border-gray-200 p-4 w-full"
                           type="file">
                </div>
                <div class="text-grey-700 flex">
                    <div v-for="image in post.images" class="p-2">
                        <img :src="image.url" :alt="post.title" :title="post.title" width="200" height="300">
                    </div>
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
    name: "Edit",

    layout: AdminLayout,

    props: {
        // categories: {
        //     type: Array,
        //     required: false
        // }
        post: Object,
        categories: Array
    },

    data() {
        return {
            _method: "put",
            entries: {
                post: {
                    id: this.post.id,
                    title: this.post.title,
                    body: this.post.body,
                    description: this.post.description,
                    category_id: this.post.category_id
                },
                tags: this.post.tags,
            }
        }
    },

    components: {
        Link
    },

    methods: {
        storePost() {
            axios.post(route('admin.posts.update', this.entries.post.id), this.entries, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
                .then((res) => {
                    // this.$refs.files_input.value = null;
                    this.entries = {
                        post: {
                            title: this.post.title,
                            body: this.post.body,
                            description: this.post.description,
                            category_id: this.post.category_id
                        },
                        tags: this.post.tags,
                    }
                })//успех
            // .catch(e) ошибка запроса
            //.finally() в любом случае
        },
        selectFile(e) {
            this.entries.post.images = e.target.files
        }
    }
}
</script>
<style scoped>

</style>

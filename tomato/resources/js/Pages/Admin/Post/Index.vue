<template>
    <div>
        <div class="mb-4">
            <Link class="inline-block px-3 py-2 bg-sky-600 border border-sky-700 text-white text-xs"
                  :href="route('admin.posts.create')">
                CREATE
            </Link>
        </div>
        <div class="mb-4 flex justify-between items-center">
            <div>
                <input @blur="checkIsEmptyTitle" v-model.lazy="filter.title" class="border border-grey-200" type="text"
                       placeholder="title">
            </div>
            <div>
                <select v-model.lazy="filter.category_title" class="border border-grey-200">
                    <option value="null">Выберите категорию</option>
                    <option v-for="category in categories" :value="category.title"> {{ category.title }}</option>
                </select>
            </div>
            <div>
                <input v-model.lazy="filter.published_at_from" class="border border-grey-200" type="date">
            </div>
            <div>
                <input v-model.lazy="filter.views_from" class="border border-grey-200" type="number"
                       placeholder="title">
            </div>
            <div v-if="Object.keys(filter).length > 0">
                <a @click.prevent="filter = {}" href="#"
                   class="inline-block px-3 py-2 bg-emerald-600 border border-emerald-700 text-white text-xs"
                >CLEAR</a>
            </div>
        </div>
        <div class="mb-4">
            <div>
                <a class="inline-block mr-2 px-2 border border-gray-200 bg-white text-gray-600"
                   :class="{'bg-blue-400': link.active, '!text-gray-300 cursor-default': !link.url}"
                   v-for="link in postsData.meta.links"
                   @click="paginationPage(link)"
                   href="#" v-html="link.label"></a>
            </div>
        </div>
        <div>
            <table class="bg-white w-full border border-grey-200">
                <thead>
                <tr>
                    <th class="p-4 border-b border-r border-gray-200">ID</th>
                    <th class="p-4 border-b border-r border-gray-200">TITLE</th>
                    <th class="p-4 border-b border-gray-200">ACTIONS</th>
                </tr>
                </thead>
                <tbody class="text-gray-600">
                <tr v-for="post in postsData.data">
                    <td class="p-4 border-b border-r border-gray-200 text-center">{{ post.id }}</td>
                    <td class="p-4 border-b border-r border-gray-200">{{ post.title }}</td>
                    <td class="p-4 border-b border-gray-200">
                        <div class="flex">
                            <div class="pr-2">
                                <Link :href="route('admin.posts.show', post.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         class="cursor-pointer size-4 text-sky-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                </Link>
                            </div>
                            <div class="pr-2">
                                <Link :href="route('admin.posts.edit', post.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         class="cursor-pointer size-4 text-green-700">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                                    </svg>

                                </Link>
                            </div>
                            <div>
                                <Link @click.prevent="deletePost(post)" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         class="cursor-pointer size-4 text-red-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                    </svg>
                                </Link>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",
    layout: AdminLayout,
    components: {
        Link
    },

    props: {
        posts: {
            type: Array,
            required: false,
        },
        categories: {
            type: Array,
            required: true,
        }
    },

    data() {
        return {
            postsData: this.posts,
            filter: {},
            pagination: {},
        }
    },

    methods: {
        paginationPage(link) {
            if (link.label.includes('Previous') && this.postsData.meta.current_page > 1) {
                this.pagination.page = this.postsData.meta.current_page - 1
            } else if (link.label.includes('Next') && this.postsData.meta.current_page < this.postsData.meta.last_page) {
                this.pagination.page = this.postsData.meta.current_page + 1
            } else {
                this.pagination.page = link.label
            }
        },

        checkIsEmptyTitle() {
            if (this.filter.title === '') {
                delete this.filter.title
                // delete this.filter['title']
            }
        },

        getPosts() {
            axios.get(route('admin.posts.index'), {
                params: {filter: this.filter, pagination: this.pagination}
            })
                .then(res => {
                    this.postsData = res.data
                });

        },

        deletePost(post) {
            axios.delete(route('admin.posts.destroy', post.id))
                .then(res => {
                    this.postsData.data = this.postsData.data.filter(postItem => postItem.id !== post.id);
                })
        }
    },

    watch: {
        filter: {
            handler() {
                this.pagination.page = 1
                this.getPosts()
            },
            deep: true
        },

        pagination: {
            handler() {
                this.getPosts()
            },
            deep: true
        }
    }
}
</script>
<style scoped>

</style>

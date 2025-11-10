<template>
    <div>
        <div class="mb-4">
            <Link class="inline-block px-3 py-2 bg-sky-600 border border-sky-700 text-white text-xs"
                  :href="route('admin.posts.create')">
                CREATE
            </Link>
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
                <tr v-for="post in posts">
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


                            <div>
                                <Link :href="route('admin.posts.edit', post.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor"
                                         class="cursor-pointer size-4 text-sky-600">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
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
        }
    }
}
</script>
<style scoped>

</style>

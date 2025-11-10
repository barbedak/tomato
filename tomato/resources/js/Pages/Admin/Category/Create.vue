<template>
    <div>
        <div class="bg-white p-4 border border-gray-200">
            <div class="text-xs mb-4">
                <Link class="inline-block px-3 py-2 bg-sky-600 border border-sky-700 text-white"
                      :href="route('admin.categories.index')">
                    Back
                </Link>
            </div>
            <div>
                <div class="mb-4">
                    <input v-model="category.title" class="border border-gray-200 p-4 w-full" type="text"
                           placeholder="title">
                </div>
                <div class="mb-4">
                    <a href="#" @click.prevent="storeCategory"
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

    data() {
        return {
            category: {
                title: '',
            }
        }
    },

    components: {
        Link
    },

    methods: {
        storeCategory() {
            axios.post(route('admin.categories.store'), this.category)
                .then((res) => {
                    this.category = {}
                })//успех
            // .catch(e) ошибка запроса
            //.finally() в любом случае
        }
    }
}
</script>
<style scoped>

</style>

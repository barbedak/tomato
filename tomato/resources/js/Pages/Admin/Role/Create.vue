<template>
    <div>
        <div class="bg-white p-4 border border-gray-200">
            <div class="text-xs mb-4">
                <Link class="inline-block px-3 py-2 bg-sky-600 border border-sky-700 text-white"
                      :href="route('admin.roles.index')">
                    Back
                </Link>
            </div>
            <div>
                <div class="mb-4">
                    <input v-model="role.title" class="border border-gray-200 p-4 w-full" type="text"
                           placeholder="title">
                </div>
                <div class="mb-4">
                    <a href="#" @click.prevent="storeRole"
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
            role: {
                title: '',
            }
        }
    },

    components: {
        Link
    },

    methods: {
        storeRole() {
            axios.post(route('admin.roles.store'), this.role)
                .then((res) => {
                    this.role = {}
                })//успех
            // .catch(e) ошибка запроса
            //.finally() в любом случае
        }
    }
}
</script>
<style scoped>

</style>

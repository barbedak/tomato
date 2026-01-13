<template>
    <div>
        <div class="bg-white p-4 border border-gray-200">
            <div>
                <div class="mb-4">
                    <input v-model="group.title" class="border border-gray-200 p-4 w-full" type="text"
                           placeholder="title">
                </div>
                <div class="mb-4">
                    <textarea v-model="group.description" class="border border-gray-200 p-4 w-full"
                           placeholder="description"/>
                </div>
                <div class="mb-4">
                    <Link method="POST" :href="route('client.groups.store')" :data="group"
                       class="text-xs px-3 py-2 bg-sky-600 border border-sky-700 text-white">STORE</Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import ClientLayout from "@/Layouts/ClientLayout.vue";

export default {
    name: "Create",

    layout: ClientLayout,

    data() {
        return {
            group: {},
        }
    },

    components: {
        Link
    },

}
</script>
<style scoped>

</style>

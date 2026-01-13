<template>
    <div>
        <div class="flex gap-4">
            <div class="w-1/2 p-4 border border-gray-200">
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                    <h3 class="text-gray-700">Groups</h3>
                    <div>
                        <Link :href="route('client.groups.create')"
                              class="inline-block px-2 py-1 bg-sky-700 border border-sky-800 text-white">+
                        </Link>
                    </div>
                </div>
                <div v-for="group in groups" class="mb-2 pb-2 border-b border-gray-200">
                    <Link :href="route('client.groups.show', group.id)">{{ group.title }}</Link>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",
    components: {Link},

    layout: ClientLayout,

    props: {
        groups: {
            type: Array,
            required: false
        }
    },

    data() {
        return {
            group: {
                title: ''

            },
        }
    }
}
</script>
<style scoped>

</style>

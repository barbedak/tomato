<template>
    <div>
        <div class="bg-white p-4 border border-gray-200">
            <div class="text-lg mb-4">
                <h1>
                    ID:
                </h1>
                <div>
                    {{ category.id }}
                </div>
            </div>

            <div>
                <h2>Title:</h2>
            </div>
            <div class="text-grey-600 text-sm mb-4">
                <p>
                    {{ category.title }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Show",
    layout: AdminLayout,
    components: {
        Link
    },

    props: {
        category: {
            type: Object,
            required: true,
        }
    }
}
</script>
<style scoped>

</style>

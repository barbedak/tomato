<template>
    <div>
        <div class="bg-white p-4 border border-gray-200">
            <div class="text-lg mb-4">
                <h1>
                    Profile:
                </h1>
                <div>
                    {{ comment.profile_name }}
                </div>
            </div>

            <div>
                <h2>To:</h2>
            </div>
            <div class="text-grey-600 text-sm mb-4">
                <p>
                    {{ comment.commentable.title }}
                </p>
            </div>
            <div>
                <h3>Say:</h3>
            </div>
            <div class="text-grey-700">
                <p>
                    {{ comment.body }}
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
        comment: {
            type: Object,
            required: true,
        }
    }
}
</script>
<style scoped>

</style>

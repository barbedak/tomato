<template>
    <div>
        <div class="bg-white p-4 border border-gray-200">
            <div class="text-lg mb-4">
                <h1>
                    Title:
                    {{ post.title }}
                </h1>
            </div>
            <div class="text-grey-600 text-sm mb-4">
                <h3>Decription:</h3>
                <p>
                    {{ post.description }}
                </p>
            </div>
            <div class="text-grey-700">
                <h3>Body: </h3>
                <p>
                    {{ post.body }}
                </p>
            </div>
            <div class="text-grey-700">
                <h3>Tags:</h3>
                {{post.tags}}
            </div>
            <div class="text-grey-700 flex">
                <div v-for="image in post.images" class="p-2">
                    <img :src="image.url" :alt="post.title" :title="post.title" width="200" height="300">
                </div>
            </div>
        </div>
        <div>
            <h3>Comments:</h3>
        </div>
        <div>
            <div v-for="comment in post.comments">
                <Link :href="route('admin.comments.show', comment.id)">{{ comment.body }}</Link>
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
        post: {
            type: Object,
            required: true,
        },

    }
}
</script>
<style scoped>

</style>

<template>
    <div>
        <div>
            <div v-for="post in posts" class="bg-white mb-4 p-4 border border-gray-200">
                <h3 class="text-lg mb-2">

                    <Link :href="route('client.posts.show', post)">{{ post.title }}</Link>
                </h3>
                <p class="text-gray-600">
                    {{ post.description }}
                </p>

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
        posts: {
            type: Array,
            required: false,
        }
    }
}
</script>
<style scoped>

</style>

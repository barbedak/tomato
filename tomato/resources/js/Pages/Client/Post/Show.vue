<template>
    <div>
        <div>
            <div class="bg-white mb-4 p-4 border border-gray-200">
                <h3 class="text-lg mb-2">
                    {{ post.title }}
                </h3>
                <p class="text-gray-600">
                    {{ post.description }}
                </p>
                <div class="flex justify-end">
                    <svg @click="toggleLike(post)"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";

export default {
    name: "Show",
    layout: ClientLayout,

    props: {
        post: {
            type: Object,
            required: true,
        }
    },

    methods: {
        toggleLike(post) {
            axios.post(route('client.posts.likes.toggle', post.id))
                .then(res => {
                    console.log(res);
                })
        }
    }
}
</script>
<style scoped>

</style>

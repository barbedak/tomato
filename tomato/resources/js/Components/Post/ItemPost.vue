<template>
    <div class="bg-white mb-4 p-4 border border-gray-200">
        {{ this.greeting }}
        <h3 class="text-lg mb-2">
            <Link v-if="!route().current('client.posts.show') " :href="route('client.posts.show', post)">
                {{ post.title }}
            </Link>
            <span v-else>{{ post.title }}</span>
        </h3>
        <p class="text-gray-600">
            {{ post.description }}
        </p>
        <div class="flex justify-end mb-4">
            <div class="flex items-center gap-2">
                <span> {{ post.liked_by_profiles_count }}</span>
                <svg @click="toggleLike()"
                     xmlns="http://www.w3.org/2000/svg"
                     :fill="post.is_liked ? '#000' : 'none'" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                </svg>
            </div>
        </div>
        <div class="flex justify-end">
            <a @click.prevent="deletePost" href="#" class="text-xs text-red-600 ">DELETE</a>
        </div>
    </div>
</template>
<script>

import {Link} from "@inertiajs/vue3";

export default {
    name: "ItemPost",
    components: {Link},

    props: {
        post: {
            type: Object,
            required: true
        }
    },

    // объявлен в далеком родителе
    inject: ['greeting'],

    methods: {
        toggleLike() {
            axios.post(route('client.posts.likes.toggle', this.post.id))
                .then(res => {
                    this.post.is_liked = res.data.is_liked
                    this.post.liked_by_profiles_count = res.data.liked_by_profiles_count
                })
        },
        deletePost(){
            axios.delete(route('client.posts.destroy', this.post.id))
                .then(res=>{
                    this.$emit('deletePost', this.post)
                })
        }
    }
}
</script>
<style scoped>

</style>

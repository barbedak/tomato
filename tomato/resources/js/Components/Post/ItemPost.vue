<template>
    <div class="bg-white mb-4 p-4 border border-gray-200">
        <div v-if="isRepost" @click="isRepost = false" class="modal-shadow flex items-center justify-center">
            <div @click.stop class="modal w-1/2 bg-white">
                <div class="mb-4">
                    <input class="border border-gray-200 p-4 w-full" type="text" placeholder="title"
                           v-model="repost.title">
                </div>
                <div class="mb-4">
                    <a href="#" @click.prevent="storeRepost"
                       class="text-xs px-3 py-2 bg-sky-600 border border-sky-700 text-white">REPOST</a>
                </div>
            </div>
        </div>
        <div v-if="post.parent_id">
            <ItemPost :post="post.parent"></ItemPost>
        </div>
        <h3 class="text-lg mb-2">
            <Link v-if="!route().current('client.posts.show') " :href="route('client.posts.show', post)">
                {{ post.title }}
            </Link>
            <span v-else>{{ post.title }}</span>
        </h3>
        <p class="text-gray-600">
            {{ post.description }}
        </p>
        <div class="flex justify-end mb-4 gap-4">
            <div class="flex items-center gap-2">
                <span> {{ post.reposts_count }}</span>
                <svg @click.prevent="createRepost" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor" class="text-sky-600 size-4 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"/>
                </svg>
            </div>
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
    // inject: ['greeting'],

    data() {
        return {
            repost: {},
            isRepost: false
        }
    },

    methods: {
        toggleLike() {
            axios.post(route('client.posts.likes.toggle', this.post.id))
                .then(res => {
                    this.post.is_liked = res.data.is_liked
                    this.post.liked_by_profiles_count = res.data.liked_by_profiles_count
                })
        }
        ,
        deletePost() {
            axios.delete(route('client.posts.destroy', this.post.id))
                .then(res => {
                    this.$emit('deletePost', this.post)
                })
        }
        ,
        createRepost() {
            this.isRepost = true
        },

        storeRepost() {
            axios.post(route('client.posts.reposts.store', this.post.id), this.repost)
                .then( res => {
                    this.post.reposts_count = res.data.reposts_count
                    this.repost = {}
                    this.isRepost = false
                })
        }
    }
}
</script>
<style scoped>
.modal-shadow {
    width: 100%;
    height: 100%;
    position: fixed;
    background: rgba(0, 0, 0, 0.6);
    top: 0;
    left: 0;
}
</style>

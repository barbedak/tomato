<template>
    <div>
        <div class="mb-4 border border-gray-200 p-4 flex items-center justify-between">
            <div> {{ profile.name }}</div>
            <div>
                <a @click.prevent="toggleSubscribe" href="#"
                   :class="[profile.is_subscribed ? 'bg-white text-sky-800' : 'text-white bg-sky-700' , 'inline-block px-3 py-2 border rounded border-sky-800']"
                >{{ profile.is_subscribed ? 'Unsubscribe' : 'Subscribe' }}</a>
            </div>
        </div>
        <div>
            <ItemPost v-for="post in postsData" @deletePost="deletePost" :post="post"></ItemPost>
        </div>
    </div>
</template>

<script>

import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";
import ItemPost from "@/Components/Post/ItemPost.vue";

export default {
    name: "Show",
    components: {ItemPost, Link},
    layout: ClientLayout,

    props: {
        posts: {
            type: Array,
            required: false,
        },
        profile: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            postsData: this.posts
        }
    },


    methods: {
        deletePost(post) {
            this.postsData = this.postsData.filter(p => p.id !== post.id)
        },

        toggleSubscribe() {
            axios.post(route('client.profiles.subscribes.toggle', this.profile.id))
                .then(res => {
                    this.profile.is_subscribed = res.data.is_subscribed
                })
        }

    }
}
</script>
<style scoped>

</style>

<template>
    <div>
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
    name: "Personal",
    components: {ItemPost, Link},
    layout: ClientLayout,

    props: {
        posts: {
            type: Array,
            required: false,
        }
    },

    data() {
        return {
            postsData: this.posts
        }
    },

    // модно использовать во всех потомках напрямую, не прокидывая
    // provide() {
    //   return {
    //       greeting: 'hello from parent'
    //   }
    // },

    methods: {
        deletePost(post) {
            this.postsData = this.postsData.filter(p => p.id !== post.id)
        }
    }
}
</script>
<style scoped>

</style>

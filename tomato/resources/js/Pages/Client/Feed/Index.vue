<template>
    <div>
        <div>
            <ItemPost v-for="post in posts" :post="post"></ItemPost>
        </div>
    </div>
</template>

<script>

import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";
import ItemPost from "@/Components/Post/ItemPost.vue";

export default {
    name: "Index",
    components: {ItemPost, Link},
    layout: ClientLayout,

    props: {
        posts: {
            type: Array,
            required: false,
        }
    },

    methods: {

    }
}
</script>
<style scoped>

</style>

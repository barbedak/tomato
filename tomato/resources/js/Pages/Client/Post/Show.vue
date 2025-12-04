<template>
    <div>
        <div>
            <ItemPost :post="post"></ItemPost>
        </div>
        <div>
            <div v-if="commentsData.data.length > 0" class="mb-4 border border-gray-200 bg-white p-4">
                <div class="mb-4">
                    <h3>Comments</h3>
                </div>
                <div>
                    <ItemComment v-for="comment in commentsData.data" :comment="comment"></ItemComment>
                </div>
            </div>
            <div v-if="is_show">
                <a href="#" @click.prevent="getComments"
                   class="block py-4 bg-sky-700 border-sky-800 text-white text-center">We need more
                    comments...</a>
            </div>
            <div class="border border-gray-200 bg-white p-4">
                <div class="mb-4">
                    <textarea v-model="comment.body" class="border border-gray-200 w-full p-4"></textarea>
                </div>
                <div>
                    <a href="#" @click.prevent="storeComment"
                       class="text-xs px-3 py-2 bg-sky-600 border border-sky-700 text-white">ADD COMMENT</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import ItemPost from "@/Components/Post/ItemPost.vue";
import ItemComment from "@/Components/Comment/ItemComment.vue";

export default {
    name: "Show",
    layout: ClientLayout,

    props: {
        post: {
            type: Object,
            required: true,
        },
        comments: {
            type: Array,
            required: false
        }
    },

    components: {
        ItemComment,
        ItemPost
    },

    data() {
        return {
            comment: {
                body: '',
            },
            page: 1,
            commentsData: this.comments,
            is_show: this.comments.meta.to < this.comments.meta.total
        }
    },

    methods: {
        storeComment() {
            axios.post(route('client.posts.comments.store', this.post.id), this.comment)
                .then(res => {
                    this.comments.push(res.data)
                    this.comment.body = ''
                })
        },
        getComments() {
            axios.get(route('client.posts.show', this.post), {
                params: {
                    page: ++this.page
                }
            })
                .then(res => {
                    this.is_show = res.data.meta.to < res.data.meta.total
                    this.commentsData.data = [...this.commentsData.data, ...res.data.data]
                })
        }
    }


}
</script>
<style scoped>

</style>

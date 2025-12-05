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
                    <ItemComment v-for="comment in commentsData.data" :comment="comment"
                                 @createReplay="createReplay"></ItemComment>
                </div>
            </div>
            <div v-if="is_show">
                <a href="#" @click.prevent="getPaginateComments"
                   class="block py-4 bg-sky-700 border-sky-800 text-white text-center">We need more
                    comments...</a>
            </div>
            <div class="border border-gray-200 bg-white p-4">
                <div v-if="replayFor.body" class="mb-4 text-gray-600 flex justify-between">
                    <div>
                        Replay for: {{ replayFor.body }}
                    </div>
                    <div>
                        <svg @click.prevent="clearReplayFor" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6 cursor-pointer text-red-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                        </svg>
                    </div>
                </div>
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
            type: Object,
            required: false
        }
    },

    components: {
        ItemComment,
        ItemPost
    },

    data() {
        return {
            commentsData: this.comments,
            comment: {
                body: '',
            },
            page: 1,
            is_show: this.comments.meta.to < this.comments.meta.total,
            replayFor: {
                body: ''
            }
        }
    },

    methods: {
        storeComment() {
            axios.post(route('client.posts.comments.index', this.post.id), this.comment)
                .then(res => {
                    this.getComments()
                    this.comment.body = ''
                    this.clearReplayFor()
                })
        },

        getPaginateComments() {
            axios.get(route('client.posts.comments.index', this.post), {
                params: {
                    page: ++this.page
                }
            })
                .then(res => {
                    this.is_show = res.data.meta.to < res.data.meta.total
                    this.commentsData.data = [...this.commentsData.data, ...res.data.data]
                })
        },

        getComments(){
            axios.get(route('client.posts.comments.index', this.post.id))
                .then(res => {
                    console.log(res);
                    this.commentsData.data = res.data.data
                })
        },

        createReplay(comment) {
            this.replayFor.body = comment.body
            // this.replayFor = comment образуется ссылка на объект и при clearReplayFor очищается body коммента
            this.comment.parent_id = comment.id
        },

        clearReplayFor() {
            this.replayFor.body = ''
        }
    }


}
</script>
<style scoped>

</style>

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
                                 @createReplay="createReplay" ></ItemComment>
                </div>
            </div>
            <div v-if="is_show">
                <a href="#" @click.prevent="getComments(++this.page)"
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
                parent_id: null,
            },
            page: 0,
            is_show:  this.comments.meta.to < this.comments.meta.total,
            replayFor: {
                body: ''
            }
        }
    },

    methods: {
        storeComment() {
            axios.post(route('client.posts.comments.store', this.post.id), this.comment)
                .then(res => {
                    // page 1 contains last stored comment
                    this.getComments(1)
                    this.comment.body = ''
                    this.clearReplayFor()
                })
        },

        getComments(page) {
            axios.get(route('client.posts.comments.index', this.post.id), {
                params: {
                    page: page
                }
            })
                .then(res => {
                    this.is_show = res.data.meta.to < res.data.meta.total
                    this.commentsData.data = this.commentsData.data.concat(res.data.data);
                    //convert each res.data.data elements to Proxy object
                    let uniqueMap = new Map();
                    this.commentsData.data.forEach(obj => {
                        uniqueMap.set(obj.id, obj);
                    });
                    //sort Map by desc
                    uniqueMap = new Map(
                        [...uniqueMap.entries()].sort((a, b) => b[0] - a[0])
                    );
                    this.commentsData.data = Array.from(uniqueMap.values());
                })
        },

        createReplay(comment) {
            this.replayFor.body = comment.body
            // this.replayFor = comment образуется ссылка на объект и при clearReplayFor очищается body коммента
            this.comment.parent_id = comment.id
        },

        clearReplayFor() {
            this.replayFor.body = ''
            this.comment.parent_id = null
        }
    }


}
</script>
<style scoped>

</style>

<template>
    <div class="">
        <div class="text-sm text-gray-300 mr-2"> {{ comment.id }}</div>
        <div class="flex justify-between">

            <div>
                <h3 class="text-lg text-gray-700">{{ comment.body }}</h3>
            </div>
            <div>
                <svg @click.prevent="createReplay(comment)" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor" class="size-6 cursor-pointer text-sky-600">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7.49 12 3.74 8.248m0 0 3.75-3.75m-3.75 3.75h16.5V19.5"/>
                </svg>
            </div>
        </div>
        <div class="text-xs text-gray-500 flex justify-between items-center">
            <span>{{ comment.name }}</span>
            <span>{{ comment.formatted_date }}</span>
        </div>
        <div class="flex mb-4 pb-2 border-b border-gray-200 justify-between">
            <div>
                <a v-if="comment.replies_count" href="#" @click.prevent="getReplies()" class="text-sky-600 text-xs">
                    Show replies ({{ comment.replies_count }})</a>
            </div>
            <div class="flex items-center gap-2">
                <span> {{ comment.liked_by_profiles_count }}</span>
                <svg @click="toggleLike()"
                     xmlns="http://www.w3.org/2000/svg"
                     :fill="comment.is_liked ? '#000' : 'none'" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-6 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                </svg>
            </div>
        </div>
        <div v-if="replies.length > 0" class="pl-4">
            <ItemComment v-for="reply in replies" @createReplay="createReplay"
                         :comment="reply"></ItemComment>
        </div>
    </div>
</template>


<script>

export default {
    name: "ItemComment",

    props: {
        comment: {
            type: Object,
            required: true
        },

    },
    data() {
        return {
            replies: []
        }
    },

    methods: {
        toggleLike() {
            axios.post(route('client.comments.likes.toggle', this.comment.id))
                .then(res => {
                    this.comment.is_liked = res.data.is_liked
                    this.comment.liked_by_profiles_count = res.data.liked_by_profiles_count
                })
        },

        createReplay(comment) {
            this.$emit('createReplay', comment)
        },

        getReplies() {
            axios.get(route('client.comments.replies.index', this.comment.id))
                .then(res => {
                    this.replies = res.data
                })
        }
    }
}
</script>
<style scoped>

</style>

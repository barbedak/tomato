<template>
    <div class="mb-4 pb-4 border-b border-gray-200">
        <div>
            <h3 class="text-lg text-gray-700">{{ comment.body }}</h3>
        </div>
        <div class="text-xs text-gray-500 flex justify-between items-center">
            <span>{{ comment.name }}</span>
            <span>{{ comment.formatted_date }}</span>
        </div>
        <div class="flex justify-end mb-4">
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
    </div>
</template>


<script>

export default {
    name: "ItemComment",

    props: {
        comment: {
            type: Object,
            required: true
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
    }
}
</script>
<style scoped>

</style>

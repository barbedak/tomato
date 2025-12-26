<template>
    <div :class="[myMessageClass, 'mb-4 p-4 border']">
        <div>
            <p class="mb-2 text-sm text-gray-600">{{ message.body }}</p>
            <div class="text-xs text-gray-400 flex justify-between items-center">
                <span>{{ message.author_name }}</span>
                <span> {{ message.formatted_date }}</span>
            </div>
        </div>
    </div>
</template>


<script>

export default {
    name: "ItemMessage",

    props: {
        auth: {
            required: true,
            type: Object
        },

        message: {
            type: Object,
            required: true
        },

    },

    computed: {
        myMessageClass() {
            return this.auth.user.id === this.message.profile_id ? 'bg-amber-50 border-amber-100' : 'bg-sky-50 border-sky-100'
        }
    }

}
</script>
<style scoped>

</style>

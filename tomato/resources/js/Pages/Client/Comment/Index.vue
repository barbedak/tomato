<template>
    <div class="w-1/2 mx-auto p-4">
        <div>
            <div v-for="comment in comments" class="bg-white mb-4 p-4 border border-gray-200">
                <h3 class="text-lg mb-2">
                    user name {{ comment.user_name }}
                </h3>
                <p class="text-gray-600">
                    {{ comment.body }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index",

    props:{
       comments: {
           type: Array,
           required: false,
       }
    }
}
</script>
<style scoped>

</style>

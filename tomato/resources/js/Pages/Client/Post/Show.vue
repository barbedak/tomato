<template>
    <div>
        <div>
            <ItemPost :post="post"></ItemPost>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import ItemPost from "@/Components/Post/ItemPost.vue";

export default {
    name: "Show",
    layout: ClientLayout,

    props: {
        post: {
            type: Object,
            required: true,
        }
    },

    components: {
        ItemPost
    }


}
</script>
<style scoped>

</style>

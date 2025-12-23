<template>
    <div>
        <div class="bg-white border-gray-200 border">
            <div class="flex">
                <div class="p-4 w-3/4 mr-2 border-r border-gray-200">
                    messages
                </div>
                <div class="w-1/4 p-4">
                    members
                </div>
            </div>
            <div class="p-4 border-t border-gray-200">
                textarea
            </div>
        </div>
    </div>
</template>

<script>

import ClientLayout from "@/Layouts/ClientLayout.vue";


export default {
    name: "Show",
    layout: ClientLayout,

    props: {
        chat: {
            type: Object,
            required: true
        }
    },

    data() {
        return {}
    },


    methods: {}
}
</script>
<style scoped>

</style>

<template>
    <div>
        <div class="bg-white border-gray-200 border">
            <div class="flex">
                <div class="p-4 w-3/4 mr-2 border-r border-gray-200">
                    <h3> {{ group.title }} </h3>
                    <p> {{ group.description }} </p>
                </div>
                <div class="w-1/4 p-4">
                    <a @click.prevent="toggleSubscribe" href="#"
                       :class="[group.is_subscribed ? 'bg-white text-sky-800' : 'text-white bg-sky-700' , 'inline-block px-3 py-2 border rounded border-sky-800']"
                    >{{ group.is_subscribed ? 'Unsubscribe' : 'Subscribe' }}</a>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

import ClientLayout from "@/Layouts/ClientLayout.vue";
import ItemMessage from "@/Components/Message/ItemMessage.vue";

export default {
    name: "Show",

    layout: ClientLayout,

    props: {
        group: {
            type: Object,
            required: true
        },
    },

    methods: {
        toggleSubscribe() {
            axios.post(route('client.groups.profiles.toggle', this.group.id ))
                .then(res => {
                    this.group.is_subscribed = res.data.is_subscribed
                })
        }
    }
}
</script>
<style scoped>

</style>

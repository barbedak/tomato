<template>
    <div>
        <div class="bg-white border-gray-200 border">
            <div class="flex">
                <div class="p-4 w-3/4 mr-2 border-r border-gray-200">
                    <ItemMessage v-for="message in messages" :auth="auth" :message="message"></ItemMessage>
                </div>
                <div class="w-1/4 p-4">
                    <div v-for="member in members" class="mb-2 pb-2 border-b border-gray-200">
                        {{ member.name }}
                    </div>
                </div>
            </div>
            <div class="p-4 border-t border-gray-200">
                <div class="mb-4">
                    <textarea v-model="message.body" class="p-4 border border-gray-200 w-full"
                              placeholder="send message"/>
                </div>
                <div>
                    <a @click.prevent="storeMessage"
                       class="inline-block text-xs text-white px-3 py-2 bg-sky-700 border border-sky-800"
                       href="#">SEND</a>
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
    components: {ItemMessage},

    layout: ClientLayout,

    props: {
        auth: {
            required: true,
            type: Object
        },
        chat: {
            type: Object,
            required: true
        },
        messages: {
            type: Array,
            required: false
        },

        members: {
            type: Array,
            required: true
        }
    },

    data() {
        return {
            message: {}
        }
    },

    created() {
        // Echo.channel(`chats.${this.chat.id}.messages.store`)
        Echo.private(`chats.${this.chat.id}.messages.store`)
            .listen('.messages.broadcast', (e) => {
                this.messages.push(e.message);
            });
    },

    methods: {
        storeMessage() {
            axios.post(route('client.chats.messages.store', this.chat.id), this.message)
                .then(res => {
                    this.messages.push(res.data);
                    this.message = {};
                })
        }
    }
}
</script>
<style scoped>

</style>

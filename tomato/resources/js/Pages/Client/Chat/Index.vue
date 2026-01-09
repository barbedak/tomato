<template>
    <div>
        <div class="flex gap-4">
            <div class="w-1/2 p-4 border border-gray-200">
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-200">
                    <h3 class="text-gray-700">CHATS</h3>
                    <div>
                        <a @click.prevent="getProfiles" href="#"
                           class="inline-block px-2 py-1 bg-sky-700 border border-sky-800 text-white">+</a>
                    </div>
                </div>
                <div v-for="chat in chats" class="mb-2 pb-2 border-b border-gray-200">
                    <Link :href="route('client.chats.show', chat.id) ">{{ chat.title }}</Link>
                </div>
            </div>
            <div v-if="showNewChatForm" class="w-1/2 p-4 border border-gray-200">

                <div>
                    <div class="mb-2 border-b border-gray-200">ADD GROUP CHAT</div>
                    <div class="mb-4">
                        <div class="mb-2">
                            <input class="border-gray-200 border p-2" v-model="chat.title" type="text"
                                   placeholder="chat name">
                            <Link method="POST" :href="route('client.chats.store')"
                                  :data="chat"
                                  class="inline-block px-2 py-2 bg-sky-700 border border-sky-800 text-white">OK
                            </Link>

                        </div>
                    </div>
                    <div v-if="profiles.length > 0" class="mb-2">
                        <input v-model.lazy="filter.name" class="border border-grey-200"
                               type="text"
                               placeholder="Search profile by Name">
                    </div>
                    <div v-for="profile in profiles" class="mb-2 border-b border-gray-200">
                        <label class="cursor-pointer mr-2" :for="profile.id">{{ profile.name }}</label>
                        <input v-model="chat.members" type="checkbox" :id="profile.id" :value="profile.id">

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",
    components: {Link},

    layout: ClientLayout,

    props: {
        chats: {
            type: Array,
            required: false
        },


    },

    data() {
        return {
            profiles: [],
            chat: {
                title: '',
                members: []
            },
            showNewChatForm: false,
            filter: {
                name: '',
            },
            pagination: {},
        }
    },

    methods: {

        getProfiles() {
            axios.get(route('client.profiles.index'), {
                params: {filter: this.filter}
            })
                .then(res => {
                    this.profiles = res.data;
                    this.showNewChatForm = true;
                })
        }
    },
    watch: {
        filter: {
            handler() {
                this.getProfiles()
            },
            deep: true
        }
    }
}
</script>
<style scoped>

</style>

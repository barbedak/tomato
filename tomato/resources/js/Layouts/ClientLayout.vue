<template>
    <div class="flex min-h-screen flex-col">
        <section class="w-full bg-white border-b border-gray-200 p-4 flex flex-row">
            <header class="w-1/2 mx-auto flex items-center justify-between">
                <nav>
                    <Link :href="route('client.feed.index')">
                        Feed
                    </Link>
                    <Link :href="route('client.profiles.personal')">
                        Personal Feed
                    </Link>
                </nav>
                <div class="relative">
                    <div @click="showNotifications" class="flex items-center justify-between gap-2 cursor-pointer">
                        <span>{{ auth.user.profile.notifications_count }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                        </svg>
                    </div>
                    <div v-if="isPopup" class="notification-popup bg-white border border-gray-200 p-4">
                        <div v-for="notification in notifications" class="cursor-pointer mb-2 pb-2">
<!--                            <Link :href="route('client.posts.show', notification.notifiable.commentable.id)">-->
<!--                                {{ notification.body }}-->
<!--                            </Link>-->
                            {{ notification.body }}
                        </div>
                        <div @click="closeNotifications" class="cursor-pointer text-center mb-2">Close</div>
                    </div>
                </div>

            </header>
        </section>
        <section class="">
            <article class="w-full p-4">
                <div class="w-1/2 mx-auto">
                    <slot/>
                </div>
            </article>
        </section>
        <section>
            <footer>

            </footer>
        </section>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "ClientLayout",

    components: {Link},

    props: {
        auth: {
            required: true,
            type: Object
        }
    },

    data() {
        return {
            isPopup: false,
            notifications: []
        }
    },

    created() {
        Echo.private(`notifications.${this.auth.user.profile.id}`)
            .listen('.notifications.broadcast', (e) => {
                this.auth.user.profile.notifications_count += 1;
            });
    },

    methods: {
        showNotifications(){
            this.getNotifications();
            this.isPopup = true;
        },

        closeNotifications(){
            this.auth.user.profile.notifications_count = 0;
            this.isPopup = false;
        },

        getNotifications() {
            axios.get(route('client.profiles.notifications.index'))
                .then(res => {
                    this.notifications = res.data;
                });
        }
    }
}

</script>

<style scoped>
.notification-popup {
    position: absolute;
    right: 0;
    width: 200px;
}
</style>

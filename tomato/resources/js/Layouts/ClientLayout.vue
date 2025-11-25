<template>
    <div class="flex min-h-screen flex-col">
        <section class="w-full bg-white border-b border-gray-200 p-4 flex flex-row">
            <header class="w-1/2 mx-auto">
                <Link :href="route('client.feed.index')">
                    Feed
                </Link>
                <Link :href="route('client.profiles.personal')">
                    Personal Feed
                </Link>
                <!--                    <Link :href="route('admin.roles.index')" :class="[$page.url === '/admin/roles' ? 'bg-gray-800' : '', 'block text-gray-300 p-4 border-b border-gray-500']">Roles</Link>-->
                <!--                    <Link :href="route('admin.posts.index')" :class="[$page.url === '/admin/posts' ? 'bg-gray-800' : '', 'block text-gray-300 p-4 border-b border-gray-500']">Posts</Link>-->
                <!--                    <Link :href="route('admin.comments.index')" :class="[$page.url === '/admin/comments' ? 'bg-gray-800' : '', 'block text-gray-300 p-4 border-b border-gray-500']">Comments</Link>-->
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

    components: {Link}
}
</script>

<style scoped>

</style>

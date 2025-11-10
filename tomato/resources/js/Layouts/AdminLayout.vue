<template>
    <div class="flex min-h-screen flex-col">
        <section class="w-full bg-white border-b border-gray-200 p-4 flex flex-row">
            <header class="w-1/2 mx-auto">
                Admin Panel
            </header>
        </section>
        <section class="flex flex-grow">
            <aside class="w-1/4 bg-gray-700">
                <div>
                    <Link :href="route('dashboard')" :class="[$page.url === '/admin/dashboard' ? 'bg-gray-800' : '', 'block text-gray-300 p-4 border-b border-gray-500']">Dashboard</Link>
                    <Link :href="route('admin.categories.index')" :class="[$page.url === '/admin/categories' ? 'bg-gray-800' : '', 'block text-gray-300 p-4 border-b border-gray-500']">Categories</Link>
                    <Link :href="route('admin.roles.index')" :class="[$page.url === '/admin/roles' ? 'bg-gray-800' : '', 'block text-gray-300 p-4 border-b border-gray-500']">Roles</Link>
                    <Link :href="route('admin.posts.index')" :class="[$page.url === '/admin/posts' ? 'bg-gray-800' : '', 'block text-gray-300 p-4 border-b border-gray-500']">Posts</Link>
                    <Link :href="route('admin.comments.index')" :class="[$page.url === '/admin/comments' ? 'bg-gray-800' : '', 'block text-gray-300 p-4 border-b border-gray-500']">Comments</Link>
                </div>
            </aside>
            <article class="w-3/4 p-4 flex-grow">
                <slot />
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
    name: "AdminLayout",

    components: {Link}
}
</script>

<style scoped>

</style>

<template>
    <header class="bg-white shadow">
        <div
            class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center"
        >
            <Link href="/" class="text-3xl font-bold text-red-600">Berita</Link>
            <nav class="space-x-4">
                <!-- <a href="#" class="text-gray-600 hover:text-gray-900">Stories</a> -->
                <!-- <a href="#" class="text-gray-600 hover:text-gray-900">Creator</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Community</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Subscribe</a> -->
            </nav>
            <div class="flex items-center space-x-4">
                <Link
                    href="/articles/create"
                    class="bg-red-600 text-white py-2 px-4 rounded-lg"
                    >Write</Link
                >
                <!-- <img src="https://via.placeholder.com/40" alt="Profile" class="h-10 w-10 rounded-full"> -->
            </div>
        </div>
    </header>
</template>

<script>
import { Link } from "@inertiajs/vue3";
export default {};
</script>

<style lang="scss" scoped></style>

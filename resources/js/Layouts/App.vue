<template>
    <main>
        <header class="text-center mt-2 bg-green-500 py-3 text-xl text-bold">
            <Link
                class="m-2"
                href="/homepage"
                :class="{ 'text-red-500': $page.url == '/homepage' }"
                >Home</Link
            >
            <Link
                class="m-2"
                href="/articles/create"
                :class="{ 'text-red-500': $page.url == '/articles/create' }"
                >Articles</Link
            >
            <Link
                class="m-2"
                href="/about"
                :class="{ 'text-red-500': $page.url == '/about' }"
                >About</Link
            >
            <Link
                class="m-2"
                href="/contact"
                :class="{ 'text-red-500': $page.url == '/contact' }"
                >Contact</Link
            >
            <Link
                class="m-2"
                href="/logout"
                method="post"
                :data="{ data: true }"
                :header="{ authorization: 123456 }"
                as="button"
                >Logout</Link
            >
        </header>
        <article>
            <slot />
        </article>
    </main>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },
};
</script>

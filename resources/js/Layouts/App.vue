<template>
    <main>
        <header class="text-center mt-2">
            <Link class="m-1" href="/">Home</Link>
            <Link class="m-1" href="/about">About</Link>
            <Link class="m-1" href="/contact">Contact</Link>
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

<template>
    <Head title="Homepage" />
    <div>
        <p class="text-green-600 mb-5 mt-4 text-5xl text-center text-extrabold">
            Welcome Homepage
        </p>
        <p class="text-center text-xl text-red-500">
            {{ $page.props.flash.success }}
        </p>

        <div class="flex">
            <div
                v-for="(item, index) in articles"
                :key="item.id"
                class="mb-5 flex-1 text-center border border-grey-500"
            >
                <img :src="`storage/${item.thumbnail}`" />
                <p v-if="item.isFeature" class="text-blue-900">Artikel Utama</p>
                <p>Judul : {{ item.title }}</p>
                <p class="mb-2">Deskripsi : {{ item.description }}</p>
                <Link :href="`articles/${item.id}/edit`" class="text-yellow-500"
                    >Edit |
                </Link>
                <Link
                    :href="`articles/${item.id}`"
                    method="delete"
                    class="text-red-500"
                    >Delete</Link
                >
            </div>
        </div>
    </div>
</template>

<script>
import { Head, Link } from "@inertiajs/vue3";

export default {
    components: {
        Head,
        Link,
    },
    props: {
        articles: {
            type: Array || Object,
            default: {},
            required: true,
        },
    },
    mounted() {
        console.log(this.articles);
    },
};
</script>

<style scoped></style>

<template>
    <Head title="Homepage" />
    <div>
        <p class="text-green-600 mb-5 mt-4 text-5xl text-center text-extrabold">
            Welcome Homepage
        </p>
        <p class="text-center text-xl text-red-500">
            {{ $page.props.flash.success }}
        </p>

        <div v-for="(item, index) in articles" :key="item.id" class="mb-5">
            <p v-if="item.isFeature" class="text-blue-900">Artikel Utama</p>
            <p>Judul : {{ item.title }}</p>
            <p class="mb-2">Deskripsi : {{ item.description }}</p>
        </div>
    </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";

export default {
    components: {
        Head,
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

<template>
    <div>
        <p class="text-green-600 mb-5 mt-4 text-5xl text-center">
            Welcome Homepage
        </p>
        <div v-for="(item, index) in articles" :key="item.id" class="mb-5">
            <p v-if="item.isFeature" class="text-blue-900">Artikel Utama</p>
            <p>Judul : {{ item.title }}</p>
            <p class="mb-2">Deskripsi : {{ item.content }}</p>
        </div>
    </div>
</template>

<script>
export default {
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

<template>
    <div>
        <p class="text-green-600 mb-5 mt-4 text-5xl text-center text-extrabold">
            Form Article
        </p>
        <form class="form mx-5" @submit.prevent="submitForm">
            <div class="my-2">
                <label class="mr-20">Title</label>
                <input
                    type="text"
                    v-model="form.title"
                    class="border border-gray-400 bg-gray-100"
                />
                <p class="text-red-500" v-if="errors.title">
                    {{ errors.title }}
                </p>
            </div>
            <div class="my-2">
                <label class="mr-10">Description</label>
                <textarea
                    class="border border-gray-400 bg-gray-100"
                    v-model="form.description"
                ></textarea>
                <p class="text-red-500" v-if="errors.description">
                    {{ errors.description }}
                </p>
            </div>
            <div class="my-2">
                <label class="mr-10">Thumbnail</label>
                <input class="border border-gray-400 bg-gray-100" type="file" />
            </div>
            <div class="my-2">
                <button class="bg-green-500 p-2">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
import { router } from "@inertiajs/vue3";

export default {
    props: {
        errors: {
            type: Object,
            default: null,
        },
    },
    data() {
        return {
            form: {
                title: "",
                description: "",
                thumbnail: "",
            },
        };
    },
    methods: {
        submitForm() {
            router.post("/articles", this.form);
        },
    },
};
</script>

<style scoped></style>

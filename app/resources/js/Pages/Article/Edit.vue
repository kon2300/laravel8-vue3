<template>
    <app-layout title="Article - Edit">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Article - Edit
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 relative">
            <jet-form-section
                @submitted="form.put(route('article.update', [articles.id]))"
            >
                <template #title>記事の編集</template>
                <template #description>記事の編集を行います</template>

                <template #form>
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="title" value="タイトル" />
                        <jet-input
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                        />
                        <jet-input-error :message="errors.title" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="content" value="コンテンツ" />
                        <jet-textarea
                            id="content"
                            class="mt-1 block w-full"
                            v-model="form.content"
                        ></jet-textarea>
                        <jet-input-error
                            :message="errors.content"
                            class="mt-2"
                        />
                    </div>
                </template>

                <template #actions>
                    <jet-button class="bg-blue-700"> 完了 </jet-button>
                </template>
            </jet-form-section>
            <jet-button
                @click="deleteArticle(articles.id)"
                class="bg-red-500 absolute right-0"
            >
                削除
            </jet-button>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetTextarea from "@/Jetstream/Textarea.vue";
import JetButton from "@/Jetstream/Button.vue";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    articles: {},
    errors: {},
});

const form = useForm({
    title: props.articles.title,
    content: props.articles.content,
});

const deleteArticle = (id) => {
    if (window.confirm("削除してもよろしいですか？")) {
        form.delete(route("article.destroy", id));
    }
};
</script>

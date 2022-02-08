<template>
    <app-layout title="Article - Create">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Article - Create
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <jet-form-section @submitted="form.post(route('article.store'))">
                <template #title>記事の作成</template>
                <template #description>記事の投稿を行います</template>

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
                    <jet-button class="bg-blue-700"> 作成 </jet-button>
                </template>
            </jet-form-section>
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
    errors: {},
});

const form = useForm({
    title: "",
    content: "",
});
</script>

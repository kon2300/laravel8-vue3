<template>
    <app-layout title="Article - Show">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Article - Show
            </h2>
        </template>

        <section class="my-8 mx-1">
            <div class="container mx-auto relative">
                <div
                    class="flex flex-col bg-white border-2 border-red-200 rounded-3xl"
                >
                    <div class="bg-yellow-100 rounded-t-3xl">
                        <h1
                            class="title-font sm:text-2xl text-xl font-medium text-center"
                        >
                            {{ articles.title }}
                        </h1>
                    </div>

                    <div>
                        <p class="px-3">
                            {{ articles.content }}
                        </p>
                    </div>

                    <div
                        class="flex"
                        v-for="tag in articles.tags"
                        :key="tag.id"
                    >
                        <p class="px-3 text-blue-400"># {{ tag.category }}</p>
                    </div>

                    <div class="justify-between px-3 sm:flex">
                        <div class="flex justify-end sm:justify-items-start">
                            <icon-base class="w-8 h-8 pt-2" icon-name="favorite"
                                ><icon-favorite
                            /></icon-base>
                            <p
                                class="text-sm bg-green-200 rounded-lg my-auto px-2 mr-10"
                            >
                                {{ Object.keys(articles.favorites).length }}
                            </p>

                            <icon-base
                                class="w-8 h-8 pt-2"
                                icon-name="speechBabble"
                                ><icon-speech-babble
                            /></icon-base>
                            <p
                                class="text-sm bg-green-200 rounded-lg my-auto px-2 mr-8"
                            >
                                {{ Object.keys(articles.comments).length }}
                            </p>

                            <Link :href="route('article.edit', [articles.id])">
                                <icon-base
                                    class="w-8 h-8 pt-2"
                                    icon-name="information"
                                    ><icon-information
                                /></icon-base>
                            </Link>
                        </div>

                        <div class="flex px-3 sm:justify-end">
                            <icon-base class="w-6 h-6 pt-1" icon-name="post"
                                ><icon-post />
                            </icon-base>
                            <p class="text-gray-400">
                                {{ articles.updated_at }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <jet-section-border />

        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <jet-form-section @submitted="form.post(route(''))">
                <template #title>コメントの作成</template>
                <template #description>コメントの投稿を行います</template>

                <template #form>
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

        <jet-section-border />

        <div class="text-2xl text-center">Article - Comments</div>

        <section class="mx-1">
            <div class="container mx-auto relative">
                <div
                    class="flex flex-col bg-white border-2 border-red-200 rounded-3xl"
                >
                    <div class="bg-blue-100 h-8 rounded-t-3xl"></div>

                    <div>
                        <p class="px-3">
                            {{ articles.content }}
                        </p>
                    </div>

                    <div class="justify-between px-3 sm:flex">
                        <div class="flex justify-end sm:justify-items-start">
                            <icon-base class="w-8 h-8 pt-2" icon-name="check"
                                ><icon-check
                            /></icon-base>
                            <p
                                class="text-sm bg-green-200 rounded-lg my-auto px-2 mr-10"
                            >
                                {{ Object.keys(articles.favorites).length }}
                            </p>

                            <icon-base
                                class="w-8 h-8 pt-2"
                                icon-name="speechBabble"
                                ><icon-speech-babble
                            /></icon-base>
                            <p
                                class="text-sm bg-green-200 rounded-lg my-auto px-2 mr-8"
                            >
                                {{ Object.keys(articles.comments).length }}
                            </p>

                            <Link :href="route('article.edit', [articles.id])">
                                <icon-base
                                    class="w-8 h-8 pt-2"
                                    icon-name="garbage"
                                    ><icon-garbage
                                /></icon-base>
                            </Link>
                        </div>

                        <div class="flex px-3 sm:justify-end">
                            <icon-base class="w-6 h-6 pt-1" icon-name="post"
                                ><icon-post />
                            </icon-base>
                            <p class="text-gray-400">
                                {{ articles.updated_at }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import IconBase from "@/svg/IconBase.vue";
import IconCheck from "@/svg/icons/IconCheck.vue";
import IconFavorite from "@/svg/icons/IconFavorite.vue";
import IconGarbage from "@/svg/icons/IconGarbage.vue";
import IconInformation from "@/svg/icons/IconInformation.vue";
import IconPost from "@/svg/icons/IconPost.vue";
import IconSpeechBabble from "@/svg/icons/IconSpeechBabble.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetTextarea from "@/Jetstream/Textarea.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    articles: {},
    errors: {},
});

const form = useForm({
    content: "",
});
</script>

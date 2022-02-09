<template>
    <app-layout title="Article">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Article - List
                </h2>
                <jet-nav-link :href="route('article.create')">
                    <jet-button> 新規投稿 </jet-button>
                </jet-nav-link>
            </div>
        </template>

        <section class="my-5">
            <div
                v-for="article in articles"
                :key="article.id"
                class="container mx-auto relative my-16 lg:w-2/3"
            >
                <div
                    class="flex flex-col bg-white border-2 border-red-200 rounded-3xl shadow-xl"
                >
                    <div class="bg-yellow-100 rounded-t-3xl">
                        <h1
                            class="title-font sm:text-2xl text-xl font-medium text-center"
                        >
                            {{ article.title }}
                        </h1>
                    </div>

                    <div>
                        <p class="px-3">
                            {{ article.content }}
                        </p>
                    </div>

                    <div class="flex" v-for="tag in article.tags" :key="tag.id">
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
                                {{ Object.keys(article.favorites).length }}
                            </p>

                            <icon-base
                                class="w-8 h-8 pt-2"
                                icon-name="speechBabble"
                                ><icon-speech-babble
                            /></icon-base>
                            <p
                                class="text-sm bg-green-200 rounded-lg my-auto px-2 mr-8"
                            >
                                {{ Object.keys(article.comments).length }}
                            </p>

                            <Link :href="route('article.show', [article.id])">
                                <icon-base
                                    class="w-8 h-8 pt-2"
                                    icon-name="handCursor"
                                    ><icon-hand-cursor
                                /></icon-base>
                            </Link>
                        </div>

                        <div class="flex px-3 sm:justify-end">
                            <icon-base class="w-6 h-6 pt-1" icon-name="post"
                                ><icon-post />
                            </icon-base>
                            <p class="text-gray-400">
                                {{ article.updated_at }}
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
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetButton from "@/Jetstream/Button.vue";
import IconBase from "@/svg/IconBase.vue";
import IconFavorite from "@/svg/icons/IconFavorite.vue";
import IconSpeechBabble from "@/svg/icons/IconSpeechBabble.vue";
import IconPost from "@/svg/icons/IconPost.vue";
import IconHandCursor from "../../svg/icons/IconHandCursor.vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    articles: {},
});
</script>

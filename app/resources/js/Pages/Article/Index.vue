<template>
    <app-layout title="Article">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Article - List
                </h2>
                <Link :href="route('articles.create')">
                    <jet-button> 新規投稿 </jet-button>
                </Link>
            </div>
        </template>

        <section class="my-5">
            <div
                v-for="article in articles"
                :key="article.id"
                class="container mx-auto relative my-16 lg:w-2/3"
            >
                <div
                    class="flex flex-col bg-white border-2 border-red-200 rounded-3xl shadow-xl px-3 pb-1"
                >
                    <div class="relative">
                        <p
                            class="title-font sm:text-2xl text-xl font-medium text-center"
                        >
                            {{ article.title }}
                        </p>
                    </div>

                    <div>
                        <Link
                            class="absolute -top-8 right-0"
                            :href="route('articles.show', [article.id])"
                        >
                            <p class="bg-green-400 rounded-2xl p-1 font-bold">
                                詳細
                            </p>
                            <icon-hand-cursor class="h-5 w-6 mx-auto" />
                        </Link>
                    </div>

                    <div class="sm:flex justify-between">
                        <div class="flex items-center">
                            <icon-user class="h-5 w-6" />
                            <p>
                                {{ article.user.name }}
                            </p>
                        </div>
                        <div class="flex">
                            <icon-post class="h-5 w-6 my-auto" />
                            <p class="text-gray-400">
                                {{ article.updated_at }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <p>
                            {{ article.content }}
                        </p>
                    </div>

                    <div class="flex" v-for="tag in article.tags" :key="tag.id">
                        <p class="text-blue-400"># {{ tag.category }}</p>
                    </div>

                    <div class="flex justify-between">
                        <div v-if="checkFavorite(article.favorites)">
                            <div class="flex">
                                <icon-favorite
                                    class="h-4 w-5 fill-yellow-500"
                                />
                                <p
                                    class="text-sm bg-orange-200 rounded-lg my-auto px-2"
                                >
                                    お気に入り済
                                    {{ Object.keys(article.favorites).length }}
                                </p>
                            </div>
                        </div>

                        <div v-else>
                            <div class="flex">
                                <icon-favorite class="h-4 w-5" />
                                <p
                                    class="text-sm bg-green-200 rounded-lg my-auto px-2"
                                >
                                    お気に入り
                                    {{ Object.keys(article.favorites).length }}
                                </p>
                            </div>
                        </div>

                        <div class="flex">
                            <icon-speech-babble class="h-5 w-5 mr-1" />
                            <p
                                class="text-sm bg-blue-200 rounded-lg my-auto px-2"
                            >
                                コメント
                                {{ Object.keys(article.comments).length }}
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
import JetButton from "@/Jetstream/Button.vue";
import IconFavorite from "@/svg/icons/IconFavorite.vue";
import IconHandCursor from "@/svg/icons/IconHandCursor.vue";
import IconPost from "@/svg/icons/IconPost.vue";
import IconSpeechBabble from "@/svg/icons/IconSpeechBabble.vue";
import IconUser from "@/svg/icons/IconUser.vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    articles: {},
    user: Number,
});

const checkFavorite = (favorites) => {
    return favorites.some((favorite) => {
        return props.user === favorite.user_id;
    });
};
</script>

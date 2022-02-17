<template>
    <app-layout title="Article - Show">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Article - Show
                </h2>
                <div v-if="article.user_id === user">
                    <jet-nav-link :href="route('articles.edit', [article.id])">
                        <jet-button> 記事の編集 </jet-button>
                    </jet-nav-link>
                </div>
            </div>
        </template>

        <section class="my-5">
            <div class="container mx-auto relative my-16 lg:w-2/3">
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

                    <div class="sm:flex justify-between">
                        <div class="flex items-center">
                            <icon-user class="h-5 w-6" />
                            <Link
                                :href="route('users.show', [article.user_id])"
                            >
                                <p>
                                    {{ article.user.name }}
                                </p>
                            </Link>
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
                        <div v-if="article.user_id === user">
                            <div class="flex">
                                <Link as="button" disabled>
                                    <icon-favorite class="h-5 w-6" />
                                </Link>
                                <p
                                    class="text-sm bg-orange-200 rounded-lg my-auto px-2"
                                >
                                    自分の投稿
                                    {{ Object.keys(article.favorites).length }}
                                </p>
                            </div>
                        </div>

                        <div v-else-if="checkFavorite(article.favorites)">
                            <div class="flex">
                                <Link
                                    :href="
                                        route('articles.favorites.destroy', [
                                            article.id,
                                            article.favorites[0].id,
                                        ])
                                    "
                                    as="button"
                                    method="delete"
                                    preserve-scroll
                                >
                                    <icon-favorite
                                        class="h-4 w-5 fill-yellow-500"
                                    />
                                </Link>
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
                                <Link
                                    :href="
                                        route('articles.favorites.store', [
                                            article.id,
                                        ])
                                    "
                                    as="button"
                                    method="post"
                                    preserve-scroll
                                >
                                    <icon-favorite class="h-4 w-5" />
                                </Link>
                                <p
                                    class="text-sm bg-green-200 rounded-lg my-auto px-2"
                                >
                                    お気に入り
                                    {{ Object.keys(article.favorites).length }}
                                </p>
                            </div>
                        </div>

                        <div class="flex">
                            <icon-speech-babble class="h-5 w-6" />
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

        <jet-section-border />

        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <jet-form-section
                @submitted="
                    form.post(route('articles.comments.store', [article.id]), {
                        preserveScroll: true,
                        onSuccess: () => form.reset(),
                    })
                "
            >
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

        <section class="my-5">
            <div
                v-for="comment in article.comments"
                :key="comment.id"
                class="container mx-auto relative my-16 lg:w-2/3"
            >
                <div
                    class="flex flex-col bg-white border-2 border-red-200 rounded-3xl shadow-xl px-3 pb-1"
                >
                    <div class="sm:flex justify-between relative">
                        <div class="flex items-center">
                            <icon-user class="h-5 w-6" />
                            <Link
                                :href="route('users.show', [comment.user_id])"
                            >
                                <p>
                                    {{ comment.user.name }}
                                </p>
                            </Link>
                        </div>
                        <div class="flex">
                            <icon-post class="h-5 w-6 my-auto" />
                            <p class="text-gray-400">
                                {{ comment.updated_at }}
                            </p>
                        </div>
                    </div>

                    <div v-if="comment.user_id === user">
                        <Link
                            class="absolute -top-5 right-0"
                            as="button"
                            @click="removeComment(comment.id)"
                        >
                            <icon-garbage class="h-5 w-6 mx-auto" />
                        </Link>
                    </div>

                    <div>
                        <p>
                            {{ comment.content }}
                        </p>
                    </div>

                    <div class="flex justify-between">
                        <div v-if="comment.user_id === user">
                            <div class="flex">
                                <Link as="button" disabled>
                                    <icon-heart class="h-5 w-6" />
                                </Link>
                                <p
                                    class="text-sm bg-orange-200 rounded-lg my-auto px-2"
                                >
                                    自分の投稿
                                    {{
                                        Object.keys(comment.comment_likes)
                                            .length
                                    }}
                                </p>
                            </div>
                        </div>

                        <div v-else-if="checkLike(comment.comment_likes)">
                            <div
                                v-for="comment_like in comment.comment_likes"
                                :key="comment_like.id"
                                class="flex"
                            >
                                <Link
                                    :href="
                                        route('articles.likes.destroy', [
                                            comment.id,
                                            comment_like.id,
                                        ])
                                    "
                                    as="button"
                                    method="delete"
                                    preserve-scroll
                                >
                                    <icon-heart class="h-5 w-6" />
                                </Link>
                                <p
                                    class="text-sm bg-orange-200 rounded-lg my-auto px-2"
                                >
                                    イイね済
                                    {{
                                        Object.keys(comment.comment_likes)
                                            .length
                                    }}
                                </p>
                            </div>
                        </div>

                        <div v-else>
                            <div class="flex">
                                <Link
                                    :href="
                                        route('articles.likes.store', [
                                            comment.id,
                                        ])
                                    "
                                    as="button"
                                    method="post"
                                    preserve-scroll
                                >
                                    <icon-heart class="h-5 w-6" />
                                </Link>
                                <p
                                    class="text-sm bg-green-200 rounded-lg my-auto px-2"
                                >
                                    イイね
                                    {{
                                        Object.keys(comment.comment_likes)
                                            .length
                                    }}
                                </p>
                            </div>
                        </div>

                        <!-- <div class="flex">
                            <icon-speech-babble class="h-5 w-6" />
                            <p
                                class="text-sm bg-blue-200 rounded-lg my-auto px-2"
                            >
                                コメント
                                {{ Object.keys(comment.nest_comments).length }}
                            </p>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import IconFavorite from "@/svg/icons/IconFavorite.vue";
import IconGarbage from "@/svg/icons/IconGarbage.vue";
import IconHeart from "@/svg/icons/IconHeart.vue";
import IconPost from "@/svg/icons/IconPost.vue";
import IconSpeechBabble from "@/svg/icons/IconSpeechBabble.vue";
import IconUser from "@/svg/icons/IconUser.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetTextarea from "@/Jetstream/Textarea.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    article: {},
    user: Number,
    errors: {},
});

const checkFavorite = (favorites) => {
    return favorites.some((favorite) => {
        return props.user === favorite.user_id;
    });
};

const checkLike = (likes) => {
    return likes.some((like) => {
        return props.user === like.user_id;
    });
};

const form = useForm({
    content: "",
});

const removeComment = (id) => {
    if (window.confirm("削除してもよろしいですか？")) {
        form.delete(
            route("articles.comments.destroy", [props.article.id, id]),
            { preserveScroll: true }
        );
    }
};
</script>

<template>
    <app-layout title="Article - Edit">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Article - Edit
                </h2>
                <jet-nav-link :href="route('article.show', [articles.id])">
                    <jet-button> 戻る </jet-button>
                </jet-nav-link>
            </div>
        </template>

        <div class="mx-auto py-10 sm:px-6 lg:px-8">
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
                    <jet-button class="bg-blue-600 hover:bg-blue-700">
                        完了
                    </jet-button>
                </template>
            </jet-form-section>

            <jet-section-border />

            <jet-action-section>
                <template #title>記事の削除</template>
                <template #description>記事の削除を行います</template>

                <template #content>
                    <jet-button
                        @click="deleteArticle(articles.id)"
                        class="bg-red-500 hover:bg-red-700"
                        >削除する
                        <icon-base class="w-5 h-5" icon-name="garbage"
                            ><icon-garbage />
                        </icon-base>
                    </jet-button>
                </template>
            </jet-action-section>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import IconBase from "@/svg/IconBase.vue";
import IconGarbage from "@/svg/icons/IconGarbage.vue";
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import JetTextarea from "@/Jetstream/Textarea.vue";
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

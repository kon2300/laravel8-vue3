<template>
    <app-layout title="Article - Edit">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Article - Edit
                </h2>
                <jet-nav-link :href="route('articles.show', [articles.id])">
                    <jet-secondary-button> 戻る </jet-secondary-button>
                </jet-nav-link>
            </div>
        </template>

        <div class="mx-auto py-10 sm:px-6 lg:px-8">
            <jet-form-section
                @submitted="form.put(route('articles.update', [articles.id]))"
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
                    <jet-danger-button @click="confirmArticleDeletion">
                        Delete Artilcle
                    </jet-danger-button>

                    <!-- Delete Article Confirmation Modal -->
                    <jet-dialog-modal
                        :show="confirmingArticleDeletion"
                        @close="closeModal"
                    >
                        <template #title> Delete Article </template>

                        <template #content> Realy?? </template>

                        <template #footer>
                            <jet-secondary-button @click="closeModal">
                                Cancel
                            </jet-secondary-button>

                            <jet-danger-button
                                @click="deleteArticle(articles.id)"
                                class="ml-3"
                                >削除する
                            </jet-danger-button>
                        </template>
                    </jet-dialog-modal>
                </template>
            </jet-action-section>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetActionSection from "@/Jetstream/ActionSection.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetDangerButton from "@/Jetstream/DangerButton.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import JetTextarea from "@/Jetstream/Textarea.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const props = defineProps({
    articles: {},
    errors: {},
});

const form = useForm({
    title: props.articles.title,
    content: props.articles.content,
});

const confirmingArticleDeletion = ref(false);

const confirmArticleDeletion = () => {
    confirmingArticleDeletion.value = true;
};

const closeModal = () => {
    confirmingArticleDeletion.value = false;
};

const deleteArticle = (id) => {
    form.delete(route("articles.destroy", id));
};
</script>

<template>
    <app-layout title="Article - Show">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Article - Show
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="bg-blue-200">{{ articles.id }}</div>
                    <div class="bg-yellow-50">{{ articles.title }}</div>
                    <div class="bg-green-200">{{ articles.content }}</div>
                </div>
                <div class="flex justify-end">
                    <jet-nav-link :href="route('article.edit', [articles.id])">
                        <jet-secondary-button> 編集 </jet-secondary-button>
                    </jet-nav-link>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

const props = defineProps({
    articles: {},
});
console.log(props.articles);
</script>

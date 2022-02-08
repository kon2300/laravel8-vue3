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

        <div v-for="article in articles" :key="article.id" class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Link :href="route('article.show', [article.id])">
                        <div class="bg-blue-200">{{ article.id }}</div>
                    </Link>
                    <div class="bg-yellow-50">{{ article.title }}</div>
                    <div class="bg-green-200">{{ article.content }}</div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import JetButton from "@/Jetstream/Button.vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    articles: {},
});
</script>

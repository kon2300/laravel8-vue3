<template>
    <app-layout title="Dashboard">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
                <div class="text-xl">
                    <Link>
                        <p>Follow</p>
                    </Link>
                </div>
            </div>
        </template>

        <section class="my-5">
            <div class="container mx-auto justify-evenly">
                <div class="flex justify-center text-4xl">User Name</div>

                <div class="flex justify-evenly text-2xl">
                    <p>Followers</p>
                    <p>Followings</p>
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
</script>

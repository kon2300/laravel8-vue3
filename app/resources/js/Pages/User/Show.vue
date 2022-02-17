<template>
    <app-layout title="User">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    User - {{ users.name }}さんのHOME
                </h2>
                <div v-if="checkFollow.length">
                    <Link
                        :href="
                            route('users.follows.destroy', [
                                users.id,
                                checkFollow[0].id,
                            ])
                        "
                        as="button"
                        method="delete"
                        preserve-scroll
                        class="flex shadow-sm bg-red-300 py-1 border-2 px-4 rounded-md hover:text-gray-600"
                    >
                        <p>UnFollow</p>
                        <icon-user-check
                            class="h-3 w-4 my-auto ml-1 fill-current"
                        />
                    </Link>
                </div>

                <div v-else>
                    <Link
                        :href="route('users.follows.store', [users.id])"
                        as="button"
                        method="post"
                        preserve-scroll
                        class="flex shadow-sm bg-blue-300 py-1 border-2 px-4 rounded-md hover:text-gray-600"
                    >
                        <p>Follow</p>
                        <icon-user-plus
                            class="h-3 w-4 my-auto ml-1 fill-current"
                        />
                    </Link>
                </div>
            </div>
        </template>

        <section class="my-5">
            <div class="container mx-auto">
                <div class="flex justify-center mb-3">
                    <icon-user class="fill-blue-300 h-32 w-32" />
                </div>

                <div class="flex justify-center mb-6">
                    <icon-at class="h-full w-10" />
                    <p class="font-black text-4xl">{{ users.name }}</p>
                </div>

                <div class="flex justify-evenly">
                    <jet-secondary-button @click="viewFollowersList">
                        Followers
                        <span
                            class="rounded-full ml-1 px-1 border-2 border-green-400"
                            >{{ Object.keys(followers).length }}</span
                        >
                    </jet-secondary-button>

                    <jet-secondary-button @click="viewFollowingsList">
                        Followings
                        <span
                            class="rounded-full ml-1 px-1 border-2 border-green-400"
                            >{{ Object.keys(followings).length }}</span
                        >
                    </jet-secondary-button>
                </div>
            </div>

            <jet-dialog-modal :show="viewingFollowersList" @close="closeModal">
                <template #title> Follower </template>

                <template #content>
                    <div v-if="followers.length">
                        <div v-for="follower in followers">
                            <Link
                                :href="
                                    route('users.show', [
                                        follower.followings.id,
                                    ])
                                "
                            >
                                <div
                                    class="flex items-center py-1 px-4 hover:bg-gray-200"
                                >
                                    <icon-user class="h-5 w-6" />
                                    <p>
                                        {{ follower.followings.name }}
                                    </p>
                                </div>
                            </Link>
                        </div>
                    </div>

                    <div v-else>
                        <p class="py-1 px-4 text-gray-300">
                            フォロワーがいません
                        </p>
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>
                </template>
            </jet-dialog-modal>

            <jet-dialog-modal :show="viewingFollowingsList" @close="closeModal">
                <template #title> Followings </template>

                <template #content>
                    <div v-if="followings.length">
                        <div v-for="following in followings">
                            <Link
                                :href="
                                    route('users.show', [
                                        following.followers.id,
                                    ])
                                "
                            >
                                <div
                                    class="flex items-center py-1 px-4 hover:bg-gray-200"
                                >
                                    <icon-user class="h-5 w-6" />
                                    <p>
                                        {{ following.followers.name }}
                                    </p>
                                </div>
                            </Link>
                        </div>
                    </div>

                    <div v-else>
                        <p class="py-1 px-4 text-gray-400">
                            フォローしているユーザーはいません
                        </p>
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>
                </template>
            </jet-dialog-modal>
        </section>
    </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import IconAt from "@/svg/icons/IconAt.vue";
import IconUser from "@/svg/icons/IconUser.vue";
import IconUserCheck from "@/svg/icons/IconUserCheck.vue";
import IconUserPlus from "@/svg/icons/IconUserPlus.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const props = defineProps({
    users: {},
    followers: {},
    followings: {},
    checkFollow: {},
});

const viewingFollowersList = ref(false);

const viewFollowersList = () => {
    viewingFollowersList.value = true;
};

const viewingFollowingsList = ref(false);

const viewFollowingsList = () => {
    viewingFollowingsList.value = true;
};

const closeModal = () => {
    viewingFollowersList.value = false;
    viewingFollowingsList.value = false;
};
</script>

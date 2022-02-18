<template>
    <div>
        <transition
            leave-active-class="transition ease-in duration-1000"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-show="on"
                class="fixed top-8 right-0 z-30 flex max-w-md bg-white shadow-lg rounded-lg overflow-hidden"
            >
                <div class="w-2 bg-blue-300"></div>
                <div class="items-center px-2 py-3">
                    <div class="mx-3 text-lg font-semibold text-gray-800">
                        <slot />
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
    props: ["on"],
});
</script>

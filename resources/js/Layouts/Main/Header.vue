<script setup>
import { ref } from "vue";

let open = ref(false);

function toggleMenu() {
    open.value = !open.value;
}
</script>
<template>
    <header class="bg-white flow-root">
        <div class="bg-red-600" style="height: 5px"></div>
        <div class="container pt-8 lg:pt-16 pb-4">
            <div class="flex flex-row items-center justify-between">
                <Link :href="route('home')" class="inline-block">
                    <img
                        class="logo"
                        src="../../../assets/img/book-world-logo.svg"
                    />
                </Link>
                <nav
                    class="flex justify-end items-center space-x-2 xs:space-x-2.5 sm:space-x-6"
                >
                    <div
                        class="text-base leading-normal text-gray-500 hover:text-gray-700"
                    >
                        <Link
                            :href="route('home')"
                            class="inline-block text-lg border-2 border-gray-200 px-4 py-2 rounded-lg hover:bg-gray-100"
                            as="button"
                            type="button"
                        >
                            Home
                        </Link>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>

<script setup>
import Footer from "./Footer.vue";
import Header from "./Header.vue";
import { toasts } from "../../Utils/eventBus.js";
import ToastAlert from "../../Components/Utils/ToastAlert.vue";
</script>

<template>
    <div>
        <ToastAlert :toasts="toasts" />
        <Header />
        <main
            class="container bg-white text-gray-700 leading-normal mt-10 mb-16 h-full"
        >
            <slot></slot>
        </main>
        <Footer />
    </div>
</template>

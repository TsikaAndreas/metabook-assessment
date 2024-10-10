<script setup>
defineProps(["title"]);
</script>
<template>
    <div class="lg:flex lg:items-center lg:justify-between mb-10">
        <div
            class="min-w-0 flex-1 border-b-2 pb-2 flex justify-between items-center"
        >
            <h2
                class="text-xl font-bold leading-7 text-gray-600 sm:truncate sm:text-3xl sm:tracking-tight"
            >
                {{ title }}
            </h2>
            <slot></slot>
        </div>
    </div>
</template>

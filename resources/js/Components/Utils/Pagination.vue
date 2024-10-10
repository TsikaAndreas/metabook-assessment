<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    pagination: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(["paginate"]);

const handlePaginate = (url) => {
    if (url) {
        emit("paginate", url);
    }
};
</script>

<template>
    <div class="mt-4 flex justify-center space-x-2">
        <button
            v-for="link in pagination.meta.links"
            :key="link.label"
            :disabled="!link.url"
            @click="handlePaginate(link.url)"
            class="px-3 py-1 rounded border"
            :class="{
                'bg-gray-200': !link.url,
                'bg-blue-500 text-white': link.active,
                'bg-white': !link.active && link.url,
            }"
        >
            <span v-html="link.label"></span>
        </button>
    </div>
</template>

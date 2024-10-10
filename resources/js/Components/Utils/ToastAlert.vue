<script setup>
import { watchEffect } from "vue";

const icons = {
    success: "fa-solid fa-check",
    error: "fa-solid fa-bug",
    warning: "fa-solid fa-triangle-exclamation",
    default: "fa-solid fa-exclamation",
};

const props = defineProps({
    toasts: {
        type: Array,
        required: true,
    },
    duration: {
        type: Number,
        default: 3000,
    },
});

const closeToast = (id) => {
    const index = props.toasts.findIndex((toast) => toast.id === id);
    if (index !== -1) {
        props.toasts.splice(index, 1);
    }
};

watchEffect(() => {
    props.toasts.forEach((toast) => {
        setTimeout(() => {
            closeToast(toast.id);
        }, props.duration);
    });
});

const getToastClass = (type) => {
    switch (type) {
        case "success":
            return "bg-green-500 border-2 border-green-600 text-white";
        case "error":
            return "bg-red-500 border-2 border-red-600 text-white";
        case "warning":
            return "bg-yellow-500 border-2 border-yellow-600 text-white";
        default:
            return "bg-white border-2 border-gray-300 text-gray-700";
    }
};

const getIcon = (type) => {
    return icons[type] || icons.default;
};
</script>

<template>
    <div class="fixed bottom-4 right-4 space-y-2 z-1000">
        <div
            v-for="toast in toasts"
            :key="toast.id"
            :class="[
                'p-4 rounded shadow-lg flex items-center',
                getToastClass(toast.type),
            ]"
        >
            <font-awesome-icon
                :icon="getIcon(toast.type)"
                class="w-6 h-6 mr-2"
            />
            <div class="flex-1">
                <span>{{ toast.message }}</span>
            </div>
            <button @click="closeToast(toast.id)" class="ml-4 text-lg">
                &times;
            </button>
        </div>
    </div>
</template>

<style scoped>
.fixed {
    z-index: 1000;
}
</style>

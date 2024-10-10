// eventBus.js
import { ref } from "vue";

const maxToastLimit = 3;

export const toasts = ref([]);

export const showToast = (message, type = "success") => {
    toasts.value.push({ message, type, id: Date.now() });
    if (toasts.value.length > maxToastLimit) {
        toasts.value.shift();
    }
};

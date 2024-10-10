<script setup>
import { defineProps, defineEmits } from "vue";
import Modal from "./Modal.vue";

const props = defineProps({
    show: Boolean,
    title: String,
    message: String,
});

const emit = defineEmits(["confirm", "cancel"]);

const handleConfirm = () => {
    emit("confirm");
};

const handleCancel = () => {
    emit("cancel");
};
</script>

<template>
    <Modal :show="show" @close="handleCancel" :title="title">
        <div class="mt-2">
            <p>{{ message }}</p>
        </div>
        <div class="bg-white px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
                @click="handleConfirm"
                type="button"
                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
            >
                Yes
            </button>
            <button
                @click="handleCancel"
                type="button"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
            >
                No
            </button>
        </div>
    </Modal>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import SectionHeading from "../Components/SectionHeading.vue";
import Modal from "../Components/Utils/Modal.vue";
import { ref } from "vue";
import ShelfList from "../Components/Shelf/ShelfList.vue";
import CreateForm from "../Components/Shelf/CreateForm.vue";
import BookList from "../Components/Book/BookList.vue";

const showModal = ref(false);

const openModal = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};
</script>

<template>
    <Head title=" | Home" />
    <div>
        <SectionHeading title="Your Shelves">
            <button
                @click="openModal"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
            >
                Add Shelf
            </button>
        </SectionHeading>
        <ShelfList />

        <SectionHeading title="Available Books to Add" class="mt-14">
            <div class="flex items-center gap-1.5">
                <font-awesome-icon :icon="['fas', 'circle-info']" />
                <p class="text-sm text-gray-500">
                    Drag and drop the books to the shelves
                </p>
            </div>
        </SectionHeading>
        <BookList />

        <Modal :show="showModal" :onClose="closeModal">
            <CreateForm @close="closeModal" />
        </Modal>
    </div>
</template>

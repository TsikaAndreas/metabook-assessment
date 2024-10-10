<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { showToast } from "../Utils/eventBus.js";
import { router, usePage } from "@inertiajs/vue3";
import SectionHeading from "../Components/SectionHeading.vue";
import Modal from "../Components/Utils/Modal.vue";
import EditForm from "../Components/Shelf/EditForm.vue";
import ConfirmationModal from "../Components/Utils/ConfirmationModal.vue";
import LoadingSpinner from "../Components/Utils/LoadingSpinner.vue";
import Pagination from "../Components/Utils/Pagination.vue";
import BookList from "../Components/Shelf/BookList.vue";

const showForm = ref(false);
const showModal = ref(false);
const data = ref(null);
const loading = ref(true);
const pagination = ref(null);
const booksLoading = ref(false);

const openEditForm = () => {
    showForm.value = true;
};

const closeEditForm = () => {
    showForm.value = false;
};

const confirmDelete = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
};

const handleDelete = async () => {
    try {
        const response = await axios.delete(`/api/shelves/${data.value.id}`);
        let message = response?.data?.message ?? "Shelf deleted successfully!";
        showToast(message, "success");
        router.get(route("home"));
    } catch (error) {
        showToast("Error deleting shelf!", "error");
    } finally {
        closeModal();
    }
};

// Method to update shelf data after successful edit
const updateShelfData = (updatedShelf) => {
    data.value.name = updatedShelf.name;
    data.value.description = updatedShelf.description;
};

const fetchPage = async (url) => {
    booksLoading.value = true;
    try {
        const response = await axios.get(url);
        data.value.books = response.data.payload.books;
        pagination.value = response.data.payload.books;
    } catch (error) {
        showToast("Error fetching books data!", "error");
    } finally {
        booksLoading.value = false;
    }
};

const removeBook = async (bookId) => {
    try {
        const response = await axios.delete(
            `/api/shelves/${data.value.id}/book/${bookId}`,
        );
        data.value.books.data = data.value.books.data.filter(
            (book) => book.id !== bookId,
        );
        let message = response?.data?.message ?? "Book removed successfully!";
        showToast(message, "success");
    } catch (error) {
        showToast("Error removing book!", "error");
    }
};

onMounted(async () => {
    try {
        const response = await axios.get(
            `/api/shelves/${usePage().props.shelf.id}`,
        );
        data.value = response.data.payload;
        pagination.value = response.data.payload.books;
    } catch (error) {
        showToast("Error fetching shelf data!", "error");
    } finally {
        loading.value = false;
    }
});
</script>

<template>
    <Head :title="data ? ` | Shelf ${data.name}` : 'Loading...'" />
    <SectionHeading :title="data ? data.name : 'Loading...'" />

    <div v-if="loading" class="flex justify-center items-center h-64">
        <LoadingSpinner />
    </div>

    <div v-else>
        <div class="flex justify-end space-x-2 mb-4">
            <button
                @click="openEditForm"
                class="bg-white-500 hover:bg-gray-100 border-2 border-gray-300 text-gray-500 px-2 py-1 rounded"
            >
                Edit
            </button>
            <button
                @click="confirmDelete"
                class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded"
            >
                Delete
            </button>
        </div>

        <div
            class="mt-6 p-6 bg-white shadow-md rounded-lg border border-gray-200"
        >
            <p class="text-md mb-2">
                <strong class="text-gray-700">ID:</strong>
                <span class="ml-2 text-gray-900">{{ data.id }}</span>
            </p>
            <p class="text-md mb-2">
                <strong class="text-gray-700">Name:</strong>
                <span class="ml-2 text-gray-900">{{ data.name }}</span>
            </p>
            <p class="text-md">
                <strong class="text-gray-700">Description:</strong>
                <span class="ml-2 text-gray-900">{{ data.description }}</span>
            </p>
        </div>

        <div v-if="booksLoading" class="flex justify-center items-center h-64">
            <LoadingSpinner />
        </div>
        <div v-else>
            <BookList :books="data.books.data" @remove-book="removeBook" />

            <Pagination
                v-if="pagination"
                :pagination="pagination"
                @paginate="fetchPage"
            />
        </div>

        <Modal :show="showForm" :onClose="closeEditForm">
            <EditForm
                :shelf="data"
                @close="closeEditForm"
                @update-shelf="updateShelfData"
            />
        </Modal>

        <ConfirmationModal
            :show="showModal"
            @confirm="handleDelete"
            @cancel="closeModal"
            title="Confirmation"
            message="Are you sure you want to delete this shelf?"
        />
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import Pagination from "../Utils/Pagination.vue";
import LoadingSpinner from "../Utils/LoadingSpinner.vue";
import { showToast } from "../../Utils/eventBus.js";

const books = ref([]);
const pagination = ref(null);
const loading = ref(true);

const fetchBooks = async (url = "/api/books") => {
    loading.value = true;
    try {
        const response = await axios.get(url);
        books.value = response.data.payload.data;
        pagination.value = response.data.payload;
    } catch (error) {
        let message =
            error?.response?.data?.message ?? "Error while fetching the books!";
        showToast(message, "error");
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchBooks();
});

const handlePaginate = (url) => {
    fetchBooks(url);
};

const onDragStart = (event, book) => {
    event.dataTransfer.setData("text/plain", book.id);
};
</script>

<template>
    <div v-if="loading" class="flex justify-center items-center h-64">
        <LoadingSpinner />
    </div>
    <div v-else>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
                v-for="book in books"
                :key="book.id"
                class="cursor-move bg-white p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 flex flex-col justify-between h-full"
                draggable="true"
                @dragstart="(event) => onDragStart(event, book)"
            >
                <div>
                    <h4 class="text-md font-semibold text-gray-800 mb-2">
                        {{ book.title }}
                    </h4>
                </div>

                <div class="mt-auto pt-4 border-t border-gray-200">
                    <p class="text-gray-700 mb-1">
                        <strong>Author:</strong> {{ book.author }}
                    </p>
                    <p class="text-gray-500 text-sm">
                        <strong>Published At:</strong>
                        {{ new Date(book.published_at).toLocaleDateString() }}
                    </p>
                </div>
            </div>
        </div>

        <Pagination
            v-if="pagination"
            :pagination="pagination"
            @paginate="handlePaginate"
        />
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import Pagination from "../Utils/Pagination.vue";
import LoadingSpinner from "../Utils/LoadingSpinner.vue";
import { showToast } from "../../Utils/eventBus.js";

const shelves = ref([]);
const pagination = ref(null);
const loading = ref(true);

const fetchShelves = async (url = "/api/shelves") => {
    loading.value = true;
    try {
        const response = await axios.get(url);
        shelves.value = response.data.payload.data;
        pagination.value = response.data.payload;
    } catch (error) {
        showToast("Error while fetching the shelves!", "error");
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchShelves();
});

const handlePaginate = (url) => {
    fetchShelves(url);
};

const onDrop = async (event, shelf) => {
    event.preventDefault();
    const bookId = event.dataTransfer.getData("text/plain");
    try {
        const response = await axios.post(
            `/api/shelves/${shelf.id}/book/${bookId}`,
        );
        let message =
            response?.data?.message ?? "Book assigned to shelf successfully!";
        showToast(message, "success");
    } catch (error) {
        let message =
            error?.response?.data?.message ??
            "Error while assigning the book to the shelf!";
        showToast(message, "warning");
    }
};

const allowDrop = (event) => {
    event.preventDefault();
};
</script>

<template>
    <div v-if="loading" class="flex justify-center items-center h-64">
        <LoadingSpinner />
    </div>
    <div v-else>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
                v-for="shelf in shelves"
                :key="shelf.id"
                class="bg-white p-4 rounded shadow"
                @drop="(event) => onDrop(event, shelf)"
                @dragover="allowDrop"
            >
                <h3 class="text-lg font-semibold">{{ shelf.name }}</h3>
                <div class="mt-2 flex justify-end space-x-2">
                    <a
                        :href="route('shelf', [shelf.id])"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded"
                    >
                        View
                    </a>
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

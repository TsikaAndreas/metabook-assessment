<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    books: {
        type: Array,
        required: true,
    },
});

const emit = defineEmits(["remove-book"]);

const removeBook = (bookId) => {
    emit("remove-book", bookId);
};
</script>

<template>
    <div class="mt-6 bg-white shadow-md rounded-lg border border-gray-200 p-6">
        <h3 class="text-xl font-bold mb-6 text-gray-800">Books</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
                v-for="book in books"
                :key="book.id"
                class="p-4 bg-gray-50 border border-gray-200 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 flex flex-col justify-between"
            >
                <div>
                    <h4 class="text-xl font-semibold mb-2 text-gray-500">
                        {{ book.title }}
                    </h4>

                    <p class="text-gray-700">
                        <strong>Author:</strong> {{ book.author }}
                    </p>

                    <p class="text-gray-600 mt-2 mb-4">
                        <strong>Description:</strong>
                        {{ book.description ?? "-" }}
                    </p>

                    <p class="text-sm text-gray-500">
                        <strong>Published At:</strong>
                        {{ book.published_at }}
                    </p>
                </div>

                <button
                    @click="removeBook(book.id)"
                    class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded self-end"
                >
                    Remove
                </button>
            </div>
        </div>
    </div>
</template>

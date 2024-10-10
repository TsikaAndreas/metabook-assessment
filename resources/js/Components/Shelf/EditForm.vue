<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, defineEmits, defineProps, watch } from "vue";
import TextInput from "../FormElements/TextInput.vue";
import Textarea from "../FormElements/Textarea.vue";
import { showToast } from "../../Utils/eventBus.js";

const emit = defineEmits(["close", "update-shelf"]);
const props = defineProps({
    shelf: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: props.shelf.name,
    description: props.shelf.description,
});

const errors = ref({});

watch(
    () => props.shelf,
    (newShelf) => {
        form.name = newShelf.name;
        form.description = newShelf.description;
    },
);

const submitForm = async () => {
    try {
        const response = await axios.put(
            `/api/shelves/${props.shelf.id}`,
            form.data(),
        );
        if (response && response.data) {
            let message =
                response.data.message ?? "Shelf updated successfully!";
            showToast(message, "success");

            // Emit the updated shelf data to the parent
            emit("update-shelf", response.data.payload);
            errors.value = {};
            emit("close");
        } else {
            throw new Error("Invalid response from server");
        }
    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors;
        } else {
            let message =
                error?.response?.data?.message ?? "An error occurred!";
            showToast(message, "error");
        }
    }
};
</script>

<template>
    <form @submit.prevent="submitForm">
        <TextInput
            name="name"
            label="Name"
            v-model="form.name"
            :error="errors.name"
        />
        <Textarea
            :type="'textarea'"
            label="Description"
            name="description"
            v-model="form.description"
            :error="errors.description"
            :required="false"
            :extraAttrs="{ rows: 3 }"
        />
        <div class="flex justify-end">
            <button
                type="button"
                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                @click="$emit('close')"
            >
                Cancel
            </button>
            <button
                type="submit"
                class="ml-3 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm"
            >
                Save
            </button>
        </div>
    </form>
</template>

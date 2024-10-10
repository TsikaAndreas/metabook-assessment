<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, defineEmits } from "vue";
import TextInput from "../FormElements/TextInput.vue";
import Textarea from "../FormElements/Textarea.vue";
import { showToast } from "../../Utils/eventBus.js";

const emit = defineEmits(["close"]);

const form = useForm({
    name: null,
    description: null,
});

const errors = ref({});

const submitForm = async () => {
    try {
        const response = await axios.post("/api/shelves", form.data());
        let message = response?.data?.message ?? "Shelf created successfully!";
        showToast(message, "success");
        errors.value = {};
        form.reset();
        emit("close");
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

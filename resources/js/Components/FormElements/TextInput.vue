<script setup>
const model = defineModel({
    type: null,
    required: true,
});
defineProps({
    name: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: "text",
    },
    required: {
        type: Boolean,
        default: true,
    },
    error: Array,
    extraAttrs: {
        type: Object,
        default: () => ({}),
    },
});
</script>
<template>
    <div class="mb-4">
        <label for="{{name}}" class="block text-sm font-medium text-gray-700">
            {{ label }}
        </label>
        <input
            v-model="model"
            :type="type"
            :id="name"
            :name="name"
            :required="required"
            class="px-3 py-2 mt-1 block w-full border shadow-sm sm:text-sm border-gray-200 rounded-md"
            :class="[error ? 'border-red-600' : '']"
            v-bind="extraAttrs"
        />
        <div v-if="error" class="mt-2 text-sm text-red-600">
            <p v-for="err in error" :key="err">{{ err }}</p>
        </div>
    </div>
</template>

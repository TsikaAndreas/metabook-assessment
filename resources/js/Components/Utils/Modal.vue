<script setup>
const props = defineProps({
    show: Boolean,
    onClose: Function,
    title: String,
});

const closeModal = () => {
    props.onClose();
};
</script>

<template>
    <div v-if="show" class="fixed z-10 inset-0 overflow-y-auto">
        <div
            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
        >
            <!-- Background overlay -->
            <div
                @click="closeModal"
                class="fixed inset-0 transition-opacity"
                aria-hidden="true"
            >
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span
                class="hidden sm:inline-block sm:align-middle sm:h-screen"
                aria-hidden="true"
                >&#8203;</span
            >

            <!-- Modal content -->
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                @click.stop
            >
                <!-- Close button (top-right) -->
                <button
                    class="absolute top-0 right-0 m-3 text-gray-400 hover:text-gray-600"
                    @click="closeModal"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1"
                        stroke="currentColor"
                        class="w-8 h-8 text-meta-gray-700"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div>
                        <div
                            class="mt-3 text-center sm:mt-0 sm:ml-4 sm:mr-4 sm:text-left"
                        >
                            <h3
                                class="text-lg leading-6 font-medium text-gray-900"
                                id="modal-title"
                            >
                                {{ title }}
                            </h3>
                            <div class="mt-6">
                                <slot></slot>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

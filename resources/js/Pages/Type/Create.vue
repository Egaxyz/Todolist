<script setup lang="ts">
import Navbar from "@/Layouts/Navbar.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";

const props = defineProps<{
    editType?: {
        id: number;
        name: string;
        description: string;
    };
}>();
const submit = () => {
    if (props.editType) {
        form.patch(route("type.update", props.editType.id), {
            preserveScroll: true,
            onSuccess: () => console.log("Type updated"),
            onError: (e) => console.error("Update error", e),
        });
    } else {
        form.post(route("type.store"), {
            preserveScroll: true,
            onSuccess: () => console.log("Type created"),
            onError: (e) => console.error("Create error", e),
        });
    }
};
const form = useForm({
    name: props.editType?.name || "",
    description: props.editType?.description || "",
});
</script>

<template>
    <Head title="Create Type" />
    <Navbar />
    <form @submit.prevent="submit">
        <div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6">
                {{ props.editType ? "Edit Type" : "Create New Type" }}
            </h1>
            <div class="mb-4">
                <label
                    for="name"
                    class="block text-sm font-medium text-gray-700"
                    >Name</label
                >
                <input
                    type="text"
                    id="name"
                    v-model="form.name"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                />
            </div>
            <div class="mb-4">
                <label
                    for="description"
                    class="block text-sm font-medium text-gray-700"
                    >Description</label
                >
                <textarea
                    id="description"
                    v-model="form.description"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                ></textarea>
            </div>
            <button
                type="submit"
                class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
                {{ props.editType ? "Update Type" : "Create Type" }}
            </button>
            <div v-if="form.errors" class="text-red-500 text-sm mt-2">
                <p v-for="(error, index) in form.errors" :key="index">
                    {{ error }}
                </p>
            </div>
            <div v-if="form.processing" class="text-blue-500 text-sm mt-2">
                Processing...
            </div>
        </div>
    </form>
</template>

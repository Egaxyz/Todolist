<script setup>
import Navbar from "@/Layouts/Navbar.vue";
import { Head, Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { ref, onMounted } from "vue";

const deleteType = (id) => {
    if (confirm("Are you sure you want to delete this type?")) {
        Inertia.delete(`/type/${id}`);
    }
};
const types = ref([]); // Assuming you have a way to fetch this data from your backend
// Fetch types from the backend when the component is mounted
onMounted(() => {
    Inertia.get(
        "/type",
        {},
        {
            onSuccess: (page) => {
                types.value = page.props.types; // Assuming your backend returns the types in this format
            },
        }
    );
});
</script>

<template>
    <Head title="Type" />
    <Navbar />
    <div class="flex flex-col">
        <div class="flex justify-between items-center p-4 bg-gray-200">
            <h1 class="text-xl font-bold">Type List</h1>
            <Link
                href="/type/create"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700"
                >Create Type</Link
            >
        </div>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Description</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(type, index) in types" :key="type.id">
                    <td class="border px-4 py-2">{{ type.id }}</td>
                    <td class="border px-4 py-2">{{ type.name }}</td>
                    <td class="border px-4 py-2">{{ type.description }}</td>
                    <td class="border px-4 py-2">
                        <Link
                            :href="`/type/${type.id}/edit`"
                            class="text-blue-500 hover:underline"
                            >Edit</Link
                        >
                        <button
                            @click="deleteType(type.id)"
                            class="text-red-500 hover:underline ml-4"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

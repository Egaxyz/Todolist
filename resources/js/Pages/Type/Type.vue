<script setup lang="ts">
import Navbar from "@/Layouts/Navbar.vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { ref, defineProps, computed } from "vue";

interface Type {
    id: number;
    name: string;
    description: string;
}

const props = defineProps<{
    type: Type[];
    success?: string;
}>();

const type = ref<Type[]>(props.type);

const { props: pageProps } = usePage();
const success = computed(() => pageProps.success);
const deleteType = (id) => {
    if (confirm("Are you sure you want to delete this type?")) {
        Inertia.delete(`/type/${id}`);
    }
};
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
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Description</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(type, index) in type" :key="type.id">
                    <td class="border px-4 py-2">{{ index + 1 }}</td>
                    <td class="border px-4 py-2">{{ type.name }}</td>
                    <td class="border px-4 py-2">{{ type.description }}</td>
                    <td class="border px-4 py-2">
                        <Link
                            :href="`/type/edit/${type.id}`"
                            class="text-blue-500 hover:underline"
                            >Edit</Link
                        >
                        <button
                            @click="deleteType(type.id)"
                            class="text-red-500 hover:text-red-700 ml-2"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

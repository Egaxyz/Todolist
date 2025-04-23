<script setup lang="ts">
import Navbar from "@/Layouts/Navbar.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/vue3";
import { defineProps } from "vue";

interface User {
    id: number;
    name: string;
    email: string;
    role: string;
}

const props = defineProps<{
    user: User[];
}>();
const deleteUser = async (userId) => {
    if (confirm("Are you sure you want to delete this user?")) {
        try {
            await Inertia.delete(route("user.destroy", userId), {
                preserveScroll: true,
                onSuccess: () => {
                    console.log("User deleted successfully");
                },
                onError: (errors) => {
                    console.log("Error deleting user:", errors);
                },
            });
        } catch (error) {
            console.error("Error deleting user:", error);
        }
    }
};
</script>

<template>
    <Head title="User" />
    <Navbar />
    <div class="flex flex-col">
        <div class="flex justify-between items-center p-4 bg-gray-200">
            <h1 class="text-xl font-bold">User List</h1>
            <Link
                href="/user/create"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700"
                >Create User</Link
            >
        </div>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Role</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(u, index) in user" :key="u.id">
                    <td class="border px-4 py-2">{{ u.id }}</td>
                    <td class="border px-4 py-2">{{ u.name }}</td>
                    <td class="border px-4 py-2">{{ u.email }}</td>
                    <td class="border px-4 py-2">{{ u.role }}</td>
                    <td class="border px-4 py-2">
                        <Link
                            :href="route('user.edit', u.id)"
                            class="text-blue-500 hover:text-blue-700"
                            >Edit</Link
                        >
                        <button
                            @click="deleteUser(u.id)"
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

<script setup lang="ts">
import Navbar from "@/Layouts/Navbar.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import { computed, defineProps, ref } from "vue";

interface User {
    id: number;
    name: string;
    email: string;
    role: string;
}

const props = defineProps<{
    user: User[];
    success?: string;
}>();

const user = ref<User[]>(props.user);
const deleteUser = (id: number) => {
    console.log("Deleting user with ID:", id);
    if (confirm("Are you sure you want to delete this user?")) {
        router.delete(route("user.destroy", id), {
            preserveState: false,
            onSuccess: () => {
                user.value = user.value.filter((u) => u.id !== id);
            },
            onError: (errors) => {
                console.error("Error deleting user:", errors);
            },
        });
    }
};

const { props: pageProps } = usePage();
const success = computed(() => pageProps.success);
</script>

<template>
    <Head title="User" />
    <Navbar />
    <div class="flex flex-col">
        <p
            v-if="success"
            class="mt-4 mx-4 p-2 bg-green-100 text-green-800 rounded"
        >
            {{ success }}
        </p>

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

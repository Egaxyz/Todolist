<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Navbar from "@/Layouts/Navbar.vue";
import { EyeIcon, EyeSlashIcon } from "@heroicons/vue/24/outline";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
const showPassword = ref(false);
const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const submit = () => {
    if (props.editUser) {
        form.patch(route("user.update", props.editUser.id), {
            preserveScroll: true,
            onSuccess: () => console.log("User updated"),
            onError: (e) => console.error("Update error", e),
        });
    } else {
        form.post(route("user.store"), {
            preserveScroll: true,
            onSuccess: () => console.log("User created"),
            onError: (e) => console.error("Create error", e),
        });
    }
};

console.log(route("user.store"));

type User = {
    id: number;
    name: string;
    email: string;
    role: string;
};
const props = defineProps<{
    editUser?: {
        id: number;
        name: string;
        email: string;
        role: string;
    };
}>();
const form = useForm({
    name: props.editUser?.name || "",
    email: props.editUser?.email || "",
    password: "",
    role: props.editUser?.role || "",
});
</script>

<template>
    <Head title="Create User" />
    <Navbar />
    <div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">
            {{ props.editUser ? "Edit User" : "Create New User" }}
        </h1>

        <form @submit.prevent="submit">
            <!-- Name Field -->
            <div class="mb-4">
                <label
                    for="name"
                    class="block text-sm font-medium text-gray-700"
                    >Name</label
                >
                <input
                    v-model="form.name"
                    id="name"
                    type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                />
                <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">
                    {{ form.errors.name }}
                </p>
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label
                    for="email"
                    class="block text-sm font-medium text-gray-700"
                    >Email</label
                >
                <input
                    v-model="form.email"
                    id="email"
                    type="email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                />
                <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">
                    {{ form.errors.email }}
                </p>
            </div>

            <!-- Password Field -->

            <div class="mb-4 relative" v-if="!props.editUser">
                <label
                    for="password"
                    class="block text-sm font-medium text-gray-700"
                >
                    Password
                </label>
                <input
                    :type="showPassword ? 'text' : 'password'"
                    v-model="form.password"
                    id="password"
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm pr-10 focus:border-indigo-500 focus:ring-indigo-500"
                />
                <button
                    type="button"
                    @click="togglePassword"
                    class="absolute inset-y-11 right-2 flex items-center text-gray-500"
                >
                    <component
                        :is="showPassword ? EyeSlashIcon : EyeIcon"
                        class="w-5 h-5"
                    />
                </button>
                <p
                    v-if="form.errors.password"
                    class="mt-1 text-sm text-red-600"
                >
                    {{ form.errors.password }}
                </p>
            </div>

            <!-- Role Field -->
            <div class="mb-4">
                <label
                    for="role"
                    class="block text-sm font-medium text-gray-700"
                    >Role</label
                >
                <select
                    v-model="form.role"
                    id="role"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <p v-if="form.errors.role" class="mt-1 text-sm text-red-600">
                    {{ form.errors.role }}
                </p>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end">
                <button
                    type="button"
                    class="mr-4 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                    @click="$inertia.get('/user')"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    :disabled="form.processing"
                >
                    <span v-if="form.processing">
                        {{ props.editUser ? "Updating..." : "Creating..." }}
                    </span>
                    <span v-else>
                        {{ props.editUser ? "Update User" : "Create User" }}
                    </span>
                </button>
            </div>
        </form>
    </div>
</template>

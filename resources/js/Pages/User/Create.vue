<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Navbar from "@/Layouts/Navbar.vue";
import { EyeIcon, EyeSlashIcon } from "@heroicons/vue/24/outline";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import User from "./User.vue";

const showPassword = ref(false);

const form = useForm({
    name: "",
    email: "",
    password: "",
    role: "",
});

const submit = () => {
    console.log("Form data before submission:", form);
    form.post(route("user.store"), {
        preserveScroll: true,
        onSuccess: () => {
            console.log("Form submitted successfully");
        },
        onError: (errors) => {
            console.log("Validation errors:", errors);
        },
        onFinish: () => {
            console.log("Request finished");
            form.reset("password");
        },
    });
};
console.log(route("user.store"));
</script>

<template>
    <Head title="Create User" />
    <Navbar />
    <form @submit.prevent="submit">
        <input type="hidden" name="_token" :value="$page.props.csrf_token" />
        <div
            class="flex flex-col my-4 items-center justify-center min-h-screen bg-white"
        >
            <div
                class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-lg"
            >
                <h2 class="text-2xl font-bold text-center">Create User</h2>

                <!-- Name -->
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <!-- Email -->
                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <!-- Password -->
                <div>
                    <InputLabel for="password" value="Password" />
                    <div class="relative">
                        <TextInput
                            id="password"
                            :type="showPassword ? 'text' : 'password'"
                            class="mt-1 block w-full pr-10"
                            v-model="form.password"
                            required
                            autocomplete="new-password"
                        />
                        <button
                            type="button"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500"
                            @click="showPassword = !showPassword"
                            tabindex="-1"
                        >
                            <component
                                :is="showPassword ? EyeSlashIcon : EyeIcon"
                                class="w-5 h-5"
                            />
                        </button>
                    </div>
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <!-- Role -->
                <div>
                    <InputLabel for="role" value="Role" />
                    <select
                        id="role"
                        v-model="form.role"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                        required
                    >
                        <option value="" disabled>Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.role" />
                </div>

                <!-- Buttons -->
                <div class="flex flex-col gap-2">
                    <button
                        type="submit"
                        class="w-full px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600"
                    >
                        Create User
                    </button>
                    <button
                        type="button"
                        class="w-full px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600"
                        @click="$inertia.get('/user')"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>

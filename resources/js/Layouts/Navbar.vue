<template>
    <nav class="bg-blue-500 text-white shadow-md px-4 py-3">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Logo -->
            <div class="text-xl font-bold">
                <a href="/">TodoList</a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex space-x-6">
                <a
                    href="/"
                    class="hover:bg-white hover:text-blue-500 rounded-lg px-3 py-2"
                    >Dashboard</a
                >
                <a
                    href="/type"
                    class="hover:bg-white hover:text-blue-500 rounded-lg px-3 py-2"
                    >Type</a
                >
                <a
                    href="/job"
                    class="hover:bg-white hover:text-blue-500 rounded-lg px-3 py-2"
                    >Job</a
                >
                <a
                    href="/user"
                    class="hover:bg-white hover:text-blue-500 rounded-lg px-3 py-2"
                    >User</a
                >
            </div>

            <!-- Logout Desktop -->
            <Link
                :href="route('logout')"
                method="post"
                as="button"
                class="hidden md:flex bg-blue-500 text-white rounded-lg px-3 py-2 hover:bg-red-600 transition"
            >
                Log Out
            </Link>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button
                    @click="open = !open"
                    class="text-white focus:outline-none"
                    aria-label="Toggle menu"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Links -->
        <div
            v-if="open"
            class="md:hidden px-4 pt-4 pb-4 space-y-3 transition-all duration-300 ease-in-out"
        >
            <a
                href="/"
                class="block text-white hover:bg-white hover:text-blue-500 rounded-lg px-3 py-2"
                >Dashboard</a
            >
            <a
                href="/type"
                class="block text-white hover:bg-white hover:text-blue-500 rounded-lg px-3 py-2"
                >Type</a
            >
            <a
                href="/job"
                class="block text-white hover:bg-white hover:text-blue-500 rounded-lg px-3 py-2"
                >Job</a
            >
            <a
                href="/user"
                class="block text-white hover:bg-white hover:text-blue-500 rounded-lg px-3 py-2"
                >User</a
            >

            <!-- Logout Mobile -->
            <Link
                :href="route('logout')"
                method="post"
                as="button"
                class="block w-full text-center bg-red-500 text-white py-2 rounded-lg hover:bg-white hover:text-blue-500 transition"
            >
                Log Out
            </Link>
        </div>
    </nav>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const open = ref(false);
</script>

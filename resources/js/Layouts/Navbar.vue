<template>
    <nav class="bg-blue-500 text-white shadow-md px-4 py-3">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Logo -->
            <div class="text-xl font-bold">
                <a href="/">TodoList</a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-6">
                <a
                    href="#"
                    class="hover:bg-white hover:text-blue-500 rounded-lg px-3 py-2"
                    >Home</a
                >
                <a
                    href="#"
                    class="hover:bg-white hover:text-blue-500 rounded-lg px-3 py-2"
                    >About</a
                >
                <a
                    href="#"
                    class="hover:bg-white hover:text-blue-500 rounded-lg px-3 py-2"
                    >Services</a
                >
                <a
                    href="#"
                    class="hover:bg-white hover:text-blue-500 rounded-lg px-3 py-2"
                    >Contact</a
                >
            </div>

            <!-- CTA / User -->
            <Link :href="route('logout')" method="post" as="button">
                Log Out
            </Link>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button
                    @click="open = !open"
                    class="text-gray-600 focus:outline-none"
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

        <!-- Mobile Menu -->
        <div v-if="open" class="md:hidden px-2 pt-2 pb-3 space-y-1">
            <a href="#" class="block text-gray-700 hover:text-pink-500">Home</a>
            <a href="#" class="block text-gray-700 hover:text-pink-500"
                >About</a
            >
            <a href="#" class="block text-gray-700 hover:text-pink-500"
                >Services</a
            >
            <a href="#" class="block text-gray-700 hover:text-pink-500"
                >Contact</a
            >
            <a href="#" class="block text-gray-700 hover:text-pink-500"
                >Login</a
            >
            <a
                href="#"
                class="block bg-pink-500 text-white text-center py-2 rounded-lg hover:bg-pink-600 transition"
                >Register</a
            >
        </div>
    </nav>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const open = ref(false);
</script>

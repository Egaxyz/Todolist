<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Navbar from "@/Layouts/Navbar.vue";
import { ref, onMounted } from "vue";

const todos = ref([
    { id: 1, task: "Cek email masuk", done: false },
    { id: 2, task: "Meeting dengan tim", done: true },
    { id: 3, task: "Review laporan keuangan", done: false },
]);

const toggleDone = (id) => {
    const todo = todos.value.find((t) => t.id === id);
    if (todo) todo.done = !todo.done;
};

const newTask = ref("");
const addTask = () => {
    if (newTask.value.trim()) {
        todos.value.push({
            id: Date.now(),
            task: newTask.value,
            done: false,
        });
        newTask.value = "";
    }
};
</script>

<template>
    <Head title="To-Do Dashboard" />
    <Navbar />

    <div class="bg-white min-h-screen p-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-blue-500">📋 To-Do List</h1>
            <p class="text-gray-600">Kelola tugas harian kamu dengan mudah.</p>
        </div>

        <!-- Add Task Input -->
        <div class="flex items-center gap-2 mb-6">
            <input
                v-model="newTask"
                type="text"
                placeholder="Tulis tugas baru..."
                class="flex-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <button
                @click="addTask"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
            >
                Tambah
            </button>
        </div>

        <!-- List of To-Dos -->
        <div class="space-y-3">
            <div
                v-for="todo in todos"
                :key="todo.id"
                class="flex items-center justify-between p-4 border rounded-lg shadow-sm"
                :class="todo.done ? 'bg-gray-50' : 'bg-white'"
            >
                <div class="flex items-center gap-3">
                    <input
                        type="checkbox"
                        :checked="todo.done"
                        @change="toggleDone(todo.id)"
                        class="accent-blue-500 w-5 h-5"
                    />
                    <span
                        :class="{ 'line-through text-gray-400': todo.done }"
                        class="text-gray-800"
                    >
                        {{ todo.task }}
                    </span>
                </div>
                <span
                    class="text-xs font-medium"
                    :class="todo.done ? 'text-green-600' : 'text-yellow-500'"
                >
                    {{ todo.done ? "Selesai" : "Belum Selesai" }}
                </span>
            </div>
        </div>
    </div>
</template>

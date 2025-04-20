<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">To-Do List</h1>
        <input
            v-model="newTodo"
            @keyup.enter="addTodo"
            class="border p-2 mr-2"
            placeholder="Tambah to-do"
        />
        <button
            @click="addTodo"
            class="bg-blue-500 text-white px-4 py-2 rounded"
        >
            Tambah
        </button>

        <ul class="mt-4">
            <li v-for="(todo, index) in todos" :key="index" class="mt-2">
                <input type="checkbox" v-model="todo.done" class="mr-2" />
                <span :class="{ 'line-through text-gray-500': todo.done }">{{
                    todo.text
                }}</span>
                <button @click="removeTodo(index)" class="text-red-500 ml-4">
                    Hapus
                </button>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { ref } from "vue";

const newTodo = ref("");
const todos = ref([]);

function addTodo() {
    if (newTodo.value.trim() !== "") {
        todos.value.push({ text: newTodo.value, done: false });
        newTodo.value = "";
    }
}

function removeTodo(index) {
    todos.value.splice(index, 1);
}
</script>

<style scoped>
.line-through {
    text-decoration: line-through;
}
</style>

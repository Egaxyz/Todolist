<script setup>
import Navbar from "@/Layouts/Navbar.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Job" />
    <Navbar />
    <div class="flex flex-col">
        <div class="flex justify-between items-center p-4 bg-gray-200">
            <h1 class="text-xl font-bold">Job List</h1>
            <Link
                href="/job/create"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700"
                >Create Job</Link
            >
        </div>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px- 4 py-2">Description</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(job, index) in jobs" :key="job.id">
                    <td class="border px-4 py-2">{{ job.id }}</td>
                    <td class="border px-4 py-2">{{ job.name }}</td>
                    <td class="border px-4 py-2">{{ job.description }}</td>
                    <td class="border px-4 py-2">
                        <Link
                            :href="`/job/${job.id}/edit`"
                            class="text-blue-500 hover:underline"
                            >Edit</Link
                        >
                        <button
                            @click="deleteJob(job.id)"
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

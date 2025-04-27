<script setup lang="ts">
import Navbar from "@/Layouts/Navbar.vue";
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";

interface Job {
    id: number;
    name: string;
    status: string;
    due_to: string;
    type_id: number;
    type: {
        id: number;
        name: string;
    };
}

const props = defineProps<{
    job: [];
}>();

const jobs = ref<Job[]>(props.job); // ini job, bukan type
const { props: pageProps } = usePage();
const success = computed(() => pageProps.success);
console.log(props.job);
const deleteJob = (id: number) => {
    if (confirm("Are you sure you want to delete this job?")) {
        Inertia.delete(`/job/${id}`, {
            onSuccess: () => {
                jobs.value = jobs.value.filter((job) => job.id !== id);
            },
        });
    }
};
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
            >
                Create Job
            </Link>
        </div>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Due To</th>
                    <th class="border px-4 py-2">Type ID</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(item, index) in jobs" :key="item.id">
                    <td class="border px-4 py-2">{{ index + 1 }}</td>
                    <td class="border px-4 py-2">{{ item.name }}</td>
                    <td class="border px-4 py-2">
                        <span v-if="item.status == 'completed'">
                            Completed
                        </span>
                        <span v-else-if="item.status == 'in_progress'">
                            In Progress
                        </span>
                        <span v-else-if="item.status == 'not_started'">
                            Not Started
                        </span>
                        <span v-else> Failed </span>
                    </td>
                    <td class="border px-4 py-2">{{ item.due_to }}</td>
                    <td class="border px-4 py-2">{{ item.type.name }}</td>
                    <td class="border px-4 py-2">
                        <Link
                            :href="`/job/edit/${item.id}`"
                            class="text-blue-500 hover:underline"
                        >
                            Edit
                        </Link>
                        <button
                            @click.prevent="deleteJob(item.id)"
                            class="text-red-500 hover:underline ml-2"
                        >
                            Delete
                        </button>
                        <Link
                            :href="`/job/detail/${item.id}`"
                            class="text-green-500 hover:underline ml-2"
                        >
                            Detail
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

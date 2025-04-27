<script setup lang="ts">
import Navbar from "@/Layouts/Navbar.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

// Props untuk data type
const props = defineProps<{
    editJob?: {
        id: number;
        name: string;
        status: string;
        due_to: string;
        description: string;
        type_id: number;
        details: {
            priority: string;
            start_date: string;
            end_date: string;
            attachment_url: string;
        }[];
    };
    types: {
        id: number;
        name: string;
    }[];
}>();

const submit = () => {
    if (props.editJob) {
        form.patch(route("job.update", props.editJob.id), {
            preserveScroll: true,
            onSuccess: () => console.log("Job updated"),
            onError: (e) => console.error("Update error", e),
        });
    } else {
        form.post(route("job.store"), {
            preserveScroll: true,
            onSuccess: () => console.log("Job created"),
            onError: (e) => console.error("Create error", e),
        });
    }
};

const form = useForm({
    name: props.editJob?.name || "",
    status: props.editJob?.status || "",
    due_to: props.editJob?.due_to || "",
    type_id: props.editJob?.type_id || "",
    description: props.editJob?.description || "",
    jobs: [
        {
            priority: props.editJob?.details?.[0]?.priority || "",
            start_date: props.editJob?.details?.[0]?.start_date || "",
            end_date: props.editJob?.details?.[0]?.end_date || "",
            url: props.editJob?.details?.[0]?.attachment_url || "",
        },
    ],
});

// Method untuk menambah field detail job
const addDetail = () => {
    form.jobs.push({
        priority: "",
        start_date: "",
        end_date: "",
        url: "",
    });
};

console.log("Edit Job Data:", props.editJob);
console.log("Details:", props.editJob?.details);
</script>

<template>
    <Head title="Create Job" />
    <Navbar />

    <form @submit.prevent="submit">
        <div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6">
                {{ props.editJob ? "Update Job" : "Create New a Job" }}
            </h1>

            <!-- Form Fields -->
            <div class="mb-4">
                <label
                    for="name"
                    class="block text-sm font-medium text-gray-700"
                    >Name</label
                >
                <input
                    autocomplete="off"
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                />
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label
                    for="description"
                    class="block text-sm font-medium text-gray-700"
                    >Description</label
                >
                <textarea
                    id="description"
                    v-model="form.description"
                    rows="3"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                ></textarea>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label
                    for="status"
                    class="block text-sm font-medium text-gray-700"
                    >Status</label
                >
                <select
                    id="status"
                    v-model="form.status"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                >
                    <option value="">Select Status</option>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                    <option value="failed">Failed</option>
                </select>
            </div>

            <!-- Due To -->
            <div class="mb-4">
                <label
                    for="due_to"
                    class="block text-sm font-medium text-gray-700"
                    >Due To</label
                >
                <input
                    id="due_to"
                    v-model="form.due_to"
                    type="datetime-local"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                />
            </div>

            <!-- Select Type -->
            <div class="mb-6">
                <label
                    for="type_id"
                    class="block text-sm font-medium text-gray-700"
                    >Select Type</label
                >
                <select
                    id="type_id"
                    v-model="form.type_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                >
                    <option value="" disabled>Select Type</option>
                    <option
                        v-for="type in types"
                        :key="type.id"
                        :value="type.id"
                    >
                        {{ type.name }}
                    </option>
                </select>
            </div>

            <!-- Job Details (Multiple) -->
            <div v-for="(job, index) in form.jobs" :key="index">
                <div class="mb-4">
                    <label
                        for="priority"
                        class="block text-sm font-medium text-gray-700"
                        >Priority</label
                    >
                    <select
                        id="priority"
                        v-model="form.jobs[index].priority"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                    >
                        <option value="" disabled>Select Priority</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label
                        for="start_date"
                        class="block text-sm font-medium text-gray-700"
                        >Start Date</label
                    >
                    <input
                        id="start_date"
                        v-model="form.jobs[index].start_date"
                        type="date"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                    />
                </div>

                <div class="mb-4">
                    <label
                        for="end_date"
                        class="block text-sm font-medium text-gray-700"
                        >End Date</label
                    >
                    <input
                        id="end_date"
                        v-model="form.jobs[index].end_date"
                        type="date"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                    />
                </div>

                <div class="mb-4">
                    <label
                        for="url"
                        class="block text-sm font-medium text-gray-700"
                        >URL</label
                    >
                    <input
                        id="url"
                        v-model="form.jobs[index].url"
                        type="text"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                    />
                </div>
            </div>

            <!-- Add Detail Button -->
            <div class="mb-6">
                <button
                    type="button"
                    @click="addDetail"
                    class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700"
                >
                    Add Detail
                </button>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
                {{ props.editJob ? "Update Job" : "Create Job" }}
            </button>
        </div>
    </form>
</template>

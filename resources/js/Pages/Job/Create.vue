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
            url: string;
        };
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
            priority: props.editJob?.details?.priority || "",
            start_date: props.editJob?.details?.start_date || "",
            end_date: props.editJob?.details?.end_date || "",
            url: props.editJob?.details?.url || "",
        },
    ],
});
</script>

<template>
    <Head title="Create Job" />
    <Navbar />

    <form @submit.prevent="submit">
        <div class="max-w-md mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-6">Create New Job</h1>

            <!-- Name -->
            <div class="mb-4">
                <label
                    for="name"
                    class="block text-sm font-medium text-gray-700"
                    >Name</label
                >
                <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                />
            </div>
            <p v-if="form.errors.name" class="text-red-500 text-sm mb-2">
                <span class="text-red-500 text-sm">Name is required</span>
            </p>

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
            <p v-if="form.errors.description" class="text-red-500 text-sm mb-2">
                <span class="text-red-500 text-sm"
                    >Description is required</span
                >
            </p>
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
            <p v-if="form.errors.status" class="text-red-500 text-sm mb-2">
                <span class="text-red-500 text-sm">Status is required</span>
            </p>
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
            <p v-if="form.errors.due_to" class="text-red-500 text-sm mb-2">
                <span class="text-red-500 text-sm">Due date is required</span>
            </p>
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
            <p v-if="form.errors.type_id" class="text-red-500 text-sm mb-2">
                <span class="text-red-500 text-sm">Type is required</span>
            </p>
            <!-- Priority -->
            <div class="mb-4">
                <label
                    for="priority"
                    class="block text-sm font-medium text-gray-700"
                    >Priority</label
                >
                <select
                    id="priority"
                    v-model="form.jobs[0].priority"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                >
                    <option value="">Select Priority</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>
            <p
                v-if="form.errors['jobs.0.priority']"
                class="text-red-500 text-sm mb-2"
            >
                <span class="text-red-500 text-sm">Priority is required</span>
            </p>
            <!-- Start Date -->
            <div class="mb-4">
                <label
                    for="start_date"
                    class="block text-sm font-medium text-gray-700"
                    >Start Date</label
                >
                <input
                    id="start_date"
                    v-model="form.jobs[0].start_date"
                    type="date"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                />
            </div>
            <p
                v-if="form.errors['jobs.0.start_date']"
                class="text-red-500 text-sm mb-2"
            >
                <span class="text-red-500 text-sm">Start date is required</span>
            </p>
            <!-- End Date -->
            <div class="mb-4">
                <label
                    for="end_date"
                    class="block text-sm font-medium text-gray-700"
                    >End Date</label
                >
                <input
                    id="end_date"
                    v-model="form.jobs[0].end_date"
                    type="date"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                />
            </div>
            <p
                v-if="form.errors['jobs.0.end_date']"
                class="text-red-500 text-sm mb-2"
            >
                <span class="text-red-500 text-sm">End date is required</span>
            </p>
            <!-- URL -->
            <div class="mb-4">
                <label for="url" class="block text-sm font-medium text-gray-700"
                    >URL</label
                >
                <input
                    id="url"
                    v-model="form.jobs[0].url"
                    type="text"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"
                />
            </div>
            <p
                v-if="form.errors['jobs.0.url']"
                class="text-red-500 text-sm mb-2"
            >
                <span class="text-red-500 text-sm">URL is required</span>
            </p>
            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700"
            >
                Create Job
            </button>

            <!-- Errors -->
            <div v-if="form.errors" class="text-red-500 text-sm mt-2">
                <p v-for="(error, index) in form.errors" :key="index">
                    {{ error }}
                </p>
            </div>

            <!-- Processing -->
            <div v-if="form.processing" class="text-blue-500 text-sm mt-2">
                Processing...
            </div>
        </div>
    </form>
</template>

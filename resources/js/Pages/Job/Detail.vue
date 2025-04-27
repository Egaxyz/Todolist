<script setup lang="ts">
import Navbar from "@/Layouts/Navbar.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps<{
    editJob?: {
        details: {
            priority: string;
            start_date: string;
            end_date: string;
            attachment_url: string;
        }[];
    };
}>();
</script>

<template>
    <Head title="Job Detail" />
    <Navbar />

    <div class="flex flex-col">
        <div class="flex justify-between items-center p-4 bg-gray-200">
            <h1 class="text-xl font-bold">Job Detail</h1>
            <Link
                href="/job"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700"
            >
                Back to Job List
            </Link>
        </div>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Priority</th>
                    <th class="border px-4 py-2">Start Date</th>
                    <th class="border px-4 py-2">End Date</th>
                    <th class="border px-4 py-2">Attachment</th>
                </tr>
            </thead>

            <tbody>
                <tr
                    v-for="(detail, index) in props.editJob?.details"
                    :key="index"
                >
                    <td class="border px-4 py-2">{{ index + 1 }}</td>
                    <td class="border px-4 py-2">{{ detail.priority }}</td>
                    <td class="border px-4 py-2">{{ detail.start_date }}</td>
                    <td class="border px-4 py-2">{{ detail.end_date }}</td>
                    <td class="border px-4 py-2">
                        <a
                            :href="detail.attachment_url"
                            target="_blank"
                            class="text-blue-500 hover:underline"
                        >
                            {{ detail.attachment_url }}
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

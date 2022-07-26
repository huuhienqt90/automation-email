<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Pagination from '@/Shared/Pagination.vue';

defineProps({
    campaigns: Object,
});
const onDelete = (campaign) => {
    if (confirm('Are you sure to delete this campaign?')) {
        const form = useForm(campaign);
        form.delete(route('campaigns.destroy', campaign));
    }
}
</script>

<template>
    <Head title="Campaigns" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Campaigns
                </h2>
                <Link :href="route('campaigns.create')">Create</Link>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto relative">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">ID</th>
                                    <th scope="col" class="py-3 px-6">Name</th>
                                    <th scope="col" class="py-3 px-6">Slug</th>
                                    <th scope="col" class="py-3 px-6">Is Private</th>
                                    <th scope="col" class="py-3 px-6 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="campaign in campaigns.data" :key="`campaign-${campaign.id}`" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6">#{{ campaign.id }}</td>
                                    <td class="py-4 px-6 font-bold"><Link :href="route('campaigns.dashboard', campaign)" class="inline-block">{{ campaign.name }}</Link></td>
                                    <td class="py-4 px-6">{{ campaign.slug }}</td>
                                    <td class="py-4 px-6">{{ campaign.is_private }}</td>
                                    <td class="py-4 px-6 text-right">
                                        <Link :href="route('campaigns.edit', campaign)" class="inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </Link>
                                        <button @click.prevent="onDelete(campaign)" class="inline-block text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <Pagination :links="campaigns.links" />
        </div>
    </BreezeAuthenticatedLayout>
</template>

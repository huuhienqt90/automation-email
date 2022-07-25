<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Pagination from '@/Shared/Pagination.vue';

defineProps({
    contacts: Object,
});
const onDelete = (company) => {
    if (confirm('Are you sure to delete this contact?')) {
        const form = useForm(company);
        form.delete(route('contacts.destroy', company));
    }
}
</script>

<template>
    <Head title="Contacts" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Contacts
                </h2>
                <Link :href="route('contacts.create')">Create</Link>
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
                                    <th scope="col" class="py-3 px-6">Avatar</th>
                                    <th scope="col" class="py-3 px-6">First Name</th>
                                    <th scope="col" class="py-3 px-6">Last Name</th>
                                    <th scope="col" class="py-3 px-6">Job Title</th>
                                    <th scope="col" class="py-3 px-6">Email</th>
                                    <th scope="col" class="py-3 px-6 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="contact in contacts.data" :key="`company-${contact.id}`" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6">#{{ contact.id }}</td>
                                    <td class="py-4 px-6">
                                        <img :src="contact.avatar_url" class="w-16 border border-gray-300" :alt="`${contact.first_name} ${contact.last_name}`" />
                                    </td>
                                    <td class="py-4 px-6 font-bold">{{ contact.first_name }}</td>
                                    <td class="py-4 px-6 font-bold">{{ contact.last_name }}</td>
                                    <td class="py-4 px-6 font-bold">{{ contact.job_title }}</td>
                                    <td class="py-4 px-6">{{ contact.email }}</td>
                                    <td class="py-4 px-6 text-right">
                                        <Link :href="route('contacts.edit', contact)" class="inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </Link>
                                        <button @click.prevent="onDelete(contact)" class="inline-block text-red-500">
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

            <Pagination :links="contacts.links" />
        </div>
    </BreezeAuthenticatedLayout>
</template>

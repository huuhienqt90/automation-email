<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from "@/Components/Input.vue";
import BreezeFileInput from "@/Components/FileInput.vue";
import BreezeInputError from "@/Components/InputError.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeButton from "@/Components/Button.vue";

const form = useForm({
    company_id: null,
    email: null,
    first_name: null,
    last_name: null,
    avatar: null,
    job_title: null,
    last_campaign: null,
    status: 0
});
const submit = () => {
    form.post(route('companies.store'))
}
</script>

<template>
    <Head title="Create a contact" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a contact
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="overflow-x-auto relative">
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <BreezeLabel for="first_name" value="First Name" />
                                <BreezeInput id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" required autofocus autocomplete="first_name" />
                                <BreezeInputError :message="form.errors.first_name" />
                            </div>
                            <div class="mb-4">
                                <BreezeLabel for="last_name" value="First Name" />
                                <BreezeInput id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name" required />
                                <BreezeInputError :message="form.errors.last_name" />
                            </div>
                            <div class="mb-4">
                                <BreezeLabel for="avatar" value="Avatar" />
                                <BreezeFileInput id="avatar" class="mt-1 block w-full" v-model="form.avatar" />
                                <BreezeInputError :message="form.errors.avatar" />
                            </div>
                            <div class="mb-4">
                                <BreezeLabel for="phone" value="Job Title" />
                                <BreezeInput id="job_title" type="text" class="mt-1 block w-full" v-model="form.job_title" />
                                <BreezeInputError :message="form.errors.job_title" />
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <BreezeButton class="ml-4" :class="{ 'opacity-50': form.processing }" :loading="form.processing" :disabled="form.processing">
                                    Create
                                </BreezeButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

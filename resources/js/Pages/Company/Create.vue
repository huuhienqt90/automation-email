<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from "@/Components/Input.vue";
import BreezeFileInput from "@/Components/FileInput.vue";
import BreezeInputError from "@/Components/InputError.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeButton from "@/Components/Button.vue";

const form = useForm({
    name: null,
    slug: null,
    email: null,
    logo: null,
    phone: null,
    website: null,
    fax: null,
    address: null
});
const submit = () => {
    form.post(route('companies.store'))
}
</script>

<template>
    <Head title="Create a company" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a company
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div class="overflow-x-auto relative">
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <BreezeLabel for="name" value="Name" />
                                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                                <BreezeInputError :message="form.errors.name" />
                            </div>
                            <div class="mb-4">
                                <BreezeLabel for="slug" value="Slug" />
                                <BreezeInput id="slug" type="text" class="mt-1 block w-full" v-model="form.slug" required />
                                <BreezeInputError :message="form.errors.slug" />
                            </div>
                            <div class="mb-4">
                                <BreezeLabel for="logo" value="Logo" />
                                <BreezeFileInput id="logo" class="mt-1 block w-full" v-model="form.logo" />
                                <BreezeInputError :message="form.errors.logo" />
                            </div>
                            <div class="mb-4">
                                <BreezeLabel for="phone" value="Phone" />
                                <BreezeInput id="phone" type="tel" class="mt-1 block w-full" v-model="form.phone" />
                                <BreezeInputError :message="form.errors.phone" />
                            </div>
                            <div class="mb-4">
                                <BreezeLabel for="email" value="Email" />
                                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                                <BreezeInputError :message="form.errors.email" />
                            </div>
                            <div class="mb-4">
                                <BreezeLabel for="address" value="Address" />
                                <BreezeInput id="address" type="text" class="mt-1 block w-full" v-model="form.address" />
                                <BreezeInputError :message="form.errors.address" />
                            </div>
                            <div class="mb-4">
                                <BreezeLabel for="website" value="Website" />
                                <BreezeInput id="website" type="url" class="mt-1 block w-full" v-model="form.website" />
                                <BreezeInputError :message="form.errors.website" />
                            </div>
                            <div class="mb-4">
                                <BreezeLabel for="fax" value="Fax" />
                                <BreezeInput id="fax" type="tel" class="mt-1 block w-full" v-model="form.fax" />
                                <BreezeInputError :message="form.errors.fax" />
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <BreezeButton class="ml-4" :class="{ 'opacity-50': form.processing }" :loading="form.processing" :disabled="form.processing">
                                    Save Changes
                                </BreezeButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

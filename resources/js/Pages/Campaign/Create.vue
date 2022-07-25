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
    sent_count: 0,
    fail_count: 0,
    open_count: 0,
    reply_count: 0,
});
const submit = () => {
    form.post(route('campaigns.store'))
}
</script>

<template>
    <Head title="Create a campaign" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create a campaign
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
                                <BreezeLabel for="sent_count" value="Sent Count" />
                                <BreezeInput id="sent_count" type="number" class="mt-1 block w-full" v-model="form.sent_count" />
                                <BreezeInputError :message="form.errors.sent_count" />
                            </div>
                            <div class="mb-4">
                                <BreezeLabel for="fail_count" value="Fail Count" />
                                <BreezeInput id="fail_count" type="number" class="mt-1 block w-full" v-model="form.fail_count" />
                                <BreezeInputError :message="form.errors.fail_count" />
                            </div>
                            <div class="mb-4">
                                <BreezeLabel for="open_count" value="Open Count" />
                                <BreezeInput id="open_count" type="number" class="mt-1 block w-full" v-model="form.open_count" />
                                <BreezeInputError :message="form.errors.open_count" />
                            </div>
                            <div class="mb-4">
                                <BreezeLabel for="reply_count" value="Reply Count" />
                                <BreezeInput id="reply_count" type="number" class="mt-1 block w-full" v-model="form.reply_count" />
                                <BreezeInputError :message="form.errors.reply_count" />
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

<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from "@/Components/Input.vue";
import BreezeFileInput from "@/Components/FileInput.vue";
import BreezeInputError from "@/Components/InputError.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeButton from "@/Components/Button.vue";
import CampaignNavigation from "@/Components/CampaignNavigation.vue";

const props = defineProps({
    campaign: Object,
});
const form = useForm({
    ...props.campaign,
    _method: "put",
});
const submit = () => {
    form.post(route('campaigns.update', props.campaign), {
        forceFormData: true,
    })
}
</script>

<template>
    <Head title="Update email templates" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update email templates
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <CampaignNavigation :campaign="campaign" />
                    <div class="overflow-x-auto relative">
                        <div class="flex w-full">
                            <form @submit.prevent="submit" class="w-3/4">
                                <h3 class="font-bold mb-4">Form data</h3>
                                <div class="mb-4 relative">
                                    <BreezeLabel for="subject" value="Subject" />
                                    <BreezeInput id="subject" type="text" class="mt-1 block w-full" v-model="form.subject" required autofocus autocomplete="subject" />
                                    <BreezeInputError :message="form.errors.subject" />
                                </div>
                                <div class="mb-4 relative">
                                    <BreezeLabel for="subject" value="Email body" />
                                    <textarea v-model="form.description" rows="10" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                                    <BreezeInputError :message="form.errors.subject" />
                                </div>
                                <div class="mb-4 relative">
                                    <BreezeLabel for="subject" value="Send Type" />
                                    <select v-model="form.send_type" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                        <option value="1">All</option>
                                        <option value="2">Company</option>
                                        <option value="3">Job Title</option>
                                        <option value="4">Contact</option>
                                    </select>
                                    <BreezeInputError :message="form.errors.send_type" />
                                </div>
                            </form>
                            <div class="attributes pl-4 w-1/4">
                                <h3 class="font-bold mb-4">Attributes</h3>
                                <span class="px-4 py-1 bg-gray-200 rounded mr-2 mb-2 text-sm italic">%first_name%</span>
                                <span class="px-4 py-1 bg-gray-200 rounded mr-2 mb-2 text-sm italic">%last_name%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

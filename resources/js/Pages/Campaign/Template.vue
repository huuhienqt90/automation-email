<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from "@/Components/Input.vue";
import BreezeFileInput from "@/Components/FileInput.vue";
import Multiselect from '@vueform/multiselect';
import BreezeInputError from "@/Components/InputError.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeButton from "@/Components/Button.vue";
import CampaignNavigation from "@/Components/CampaignNavigation.vue";
import { ref, computed } from "vue";

const props = defineProps({
    campaign: Object,
    contacts: Array,
    jobTitles: Array,
    companies: Array
});
const form = useForm({
    ...props.campaign,
    send_values: props.campaign.send_values ?? [],
    _method: "put",
});
let searchSendValue = ref([]);
const filteredJobTitles = computed( () => {
    if (searchSendValue.value) {
        return props.jobTitles.filter(job => job.job_title.includes(searchSendValue.value))
    }
    return props.jobTitles
})
const filteredCompanies = computed( () => {
    if (searchSendValue.value) {
        return props.companies.filter(company => company.name.includes(searchSendValue.value))
    }
    return props.companies
})
const filteredContacts = computed( () => {
    if (searchSendValue.value) {
        return props.contacts.filter(contact => contact.first_name.includes(searchSendValue.value) || contact.last_name.includes(searchSendValue.value))
    }
    return props.contacts
})
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
                <div class="bg-white shadow-sm sm:rounded-lg p-4">
                    <CampaignNavigation :campaign="campaign" />
                    <div class="relative">
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
                                <div class="mb-4 relative">
                                    <BreezeLabel for="subject" value="Send Values" />
                                    <BreezeInput id="searchSendValue" type="text" class="mt-1 block w-full" v-model="searchSendValue" />
                                    <div class="grid grid-cols-3 gap-4 mt-4 overflow-y-auto border border-gray-300 p-4 rounded-md shadow-sm" style="max-height: 300px;">
                                        <template v-if="parseInt(form.send_type) === 3">
                                            <label v-for="job in filteredJobTitles" :key="`job-title-${job.job_title}-${searchSendValue}`"><input type="checkbox" v-model="form.send_values" :value="job.job_title" /> <span class="ml-2">{{ job.job_title }}</span></label>
                                        </template>
                                        <template v-else-if="parseInt(form.send_type) === 2">
                                            <label v-for="company in filteredCompanies" :key="`company-${company.id}-${searchSendValue}`"><input type="checkbox" v-model="form.send_values" :value="company.id" /> <span class="ml-2">{{ company.name }}</span></label>
                                        </template>
                                        <template v-else>
                                            <label v-for="contact in filteredContacts" :key="`contact-${contact.id}-${searchSendValue}`"><input type="checkbox" v-model="form.send_values" :value="contact.id" /> <span class="ml-2">{{ contact.last_name }} {{ contact.first_name }}</span></label>
                                        </template>
                                    </div>
                                    <BreezeInputError :message="form.errors.send_values" />
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <BreezeButton class="ml-4" :class="{ 'opacity-50': form.processing }" :loading="form.processing" :disabled="form.processing">
                                        Save Changes
                                    </BreezeButton>
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

<style src="@vueform/multiselect/themes/tailwind.css"></style>

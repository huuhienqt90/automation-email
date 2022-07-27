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
    <Head title="Update campaign schedules" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Update campaign schedules
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg p-4">
                    <CampaignNavigation :campaign="campaign" />
                    <div class="relative">
                        <form @submit.prevent="submit">
                            <div class="mb-4 relative">
                                <BreezeLabel for="subject" value="Subject" />
                                <div class="flex items-center justify-between max-w-2xl">
                                    <label>
                                        <input type="radio" v-model="form.type" value="1" />
                                        <span class="ml-2">Send immediately</span>
                                    </label>
                                    <label>
                                        <input type="radio" v-model="form.type" value="2" />
                                        <span class="ml-2">Send today</span>
                                    </label>
                                    <label>
                                        <input type="radio" v-model="form.type" value="3" />
                                        <span class="ml-2">Custom</span>
                                    </label>
                                </div>
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

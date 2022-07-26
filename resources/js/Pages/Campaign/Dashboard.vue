<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeInput from "@/Components/Input.vue";
import BreezeFileInput from "@/Components/FileInput.vue";
import BreezeInputError from "@/Components/InputError.vue";
import CampaignNavigation from "@/Components/CampaignNavigation.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeButton from "@/Components/Button.vue";

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
    <Head title="Edit a campaign" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit a campaign
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <CampaignNavigation :campaign="campaign" />
                    <div class="flex w-full">
                        <h2 class="font-bold text-3xl my-4">Percentages: </h2>
                    </div>
                    <div class="overflow-x-auto relative flex w-full justify-between">
                        <div class="progress">
                            <h4 class="font-bold text-yellow-400">Sent</h4>
                            <span class="text-sm text-yellow-400">0/100</span>
                            <div class="barOverflow">
                                <div class="bar border-b-yellow-400 border-r-yellow-400"></div>
                            </div>
                            <span>50</span>%
                        </div>
                        <div class="progress">
                            <h4 class="font-bold text-pink-400">Open</h4>
                            <span class="text-sm text-pink-400">0/100</span>
                            <div class="barOverflow">
                                <div class="bar border-b-pink-400 border-r-pink-400"></div>
                            </div>
                            <span>50</span>%
                        </div>
                        <div class="progress">
                            <h4 class="font-bold text-teal-400">Click</h4>
                            <span class="text-sm text-teal-400">0/100</span>
                            <div class="barOverflow">
                                <div class="bar border-b-teal-400 border-r-teal-400"></div>
                            </div>
                            <span>50</span>%
                        </div>
                        <div class="progress">
                            <h4 class="font-bold text-blue-400">Reply</h4>
                            <span class="text-sm text-blue-400">0/100</span>
                            <div class="barOverflow">
                                <div class="bar border-b-blue-400 border-r-blue-400"></div>
                            </div>
                            <span>50</span>%
                        </div>
                        <div class="progress">
                            <h4 class="font-bold text-orange-400">Unsubscribe</h4>
                            <span class="text-sm text-orange-400">0/100</span>
                            <div class="barOverflow">
                                <div class="bar border-b-orange-400 border-r-orange-400"></div>
                            </div>
                            <span>50</span>%
                        </div>
                        <div class="progress">
                            <h4 class="font-bold text-purple-400">Bounce</h4>
                            <span class="text-sm text-purple-400">0/100</span>
                            <div class="barOverflow">
                                <div class="bar border-b-purple-400 border-r-purple-400"></div>
                            </div>
                            <span>50</span>%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<style>
.progress{
    position: relative;
    margin: 4px;
    float:left;
    text-align: center;
}
.barOverflow{ /* Wraps the rotating .bar */
    position: relative;
    width: 180px; height: 90px; /* Half circle (overflow) */
    margin-bottom: -14px; /* bring the numbers up */
    overflow: hidden;
}
.bar{
    position: absolute;
    top: 0; left: 0;
    width: 180px; height: 180px;
    border-radius: 50%;
    border-width: 20px;
    box-sizing: border-box;
    transform: rotate(180deg);
}
</style>

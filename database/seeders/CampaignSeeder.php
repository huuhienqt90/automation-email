<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campaign::factory(100)
            ->create()
            ->each(function ($campaign) {
                Contact::factory(50)
                    ->create()
                    ->each(function ($contact) use ($campaign) {
                        $campaign->contacts()->attach($contact);
                    });
            });
    }
}

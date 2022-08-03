<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Notifications\CampaignNotification;
use Illuminate\Console\Command;

class CampaignCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaign:send {campaign}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notification to contacts in a campaign';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $campaign = Campaign::find($this->argument('campaign'));
        if ($campaign->contacts()->count()) {
            foreach ($campaign->contacts as $contact) {
                $contact->notify(new CampaignNotification($campaign, $contact));
            }
        }
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
             'name' => 'Administrator',
             'email' => 'admin@gmail.com',
        ]);
        $this->call(CampaignSeeder::class);
        $this->call(ContactSeeder::class);
    }
}

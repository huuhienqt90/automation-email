<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->words(4, true),
            'slug' => $this->faker->unique()->slug(),
            'status' => Status::Activated,
            'is_private' => false,
            'sent_count' => 0,
            'fail_count' => 0,
            'open_count' => 0,
            'reply_count' => 0
        ];
    }
}

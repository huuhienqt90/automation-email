<?php

namespace Database\Factories;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'slug' => $this->faker->unique()->slug,
            'logo' => null,
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->email(),
            'address' => $this->faker->address(),
            'website' => $this->faker->url(),
            'fax' => $this->faker->phoneNumber(),
            'status' => Status::Activated
        ];
    }
}

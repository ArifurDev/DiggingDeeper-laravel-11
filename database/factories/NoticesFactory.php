<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\notices>
 */
class NoticesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'notice' => $this->faker->sentence, // Generate a random sentence for the notice
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

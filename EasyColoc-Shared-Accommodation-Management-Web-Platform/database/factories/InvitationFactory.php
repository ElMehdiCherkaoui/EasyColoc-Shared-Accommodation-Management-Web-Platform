<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invitation>
 */
class InvitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shared_accommodation_id' => \App\Models\SharedAccommodation::factory(),
            'email' => fake()->safeEmail(),
            'token' => \Illuminate\Support\Str::random(32),
            'status' => fake()->randomElement(['pending', 'accepted', 'declined']),
        ];
    }
}

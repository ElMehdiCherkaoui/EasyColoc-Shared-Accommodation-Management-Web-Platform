<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membership>
 */
class MembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'shared_accommodation_id' => \App\Models\SharedAccommodation::factory(),
            'role' => 'member',
            'joined_at' => fake()->dateTimeThisYear(),
            'is_active' => true,
            'has_debt' => fake()->boolean(20),
        ];

    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
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
            'category_id' => \App\Models\Category::factory(),
            'user_id' => \App\Models\User::factory(),
            'paid' => fake()->boolean(),
            'title' => fake()->sentence(3),
            'amount' => fake()->randomFloat(2, 10, 500),
            'expense_date' => fake()->date(),
        ];
    }
}

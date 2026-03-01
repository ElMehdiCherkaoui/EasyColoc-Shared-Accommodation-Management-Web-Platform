<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        $isPaid = fake()->boolean(60);

        return [
            'shared_accommodation_id' => \App\Models\SharedAccommodation::factory(),
            'expense_id' => \App\Models\Expense::factory(),
            'receiver_user_id' => \App\Models\User::factory(),
            'amount' => fake()->randomFloat(2, 5, 300),
            'is_paid' => $isPaid,
            'payment_date' => $isPaid ? fake()->date() : null,
        ];
    }
}

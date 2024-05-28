<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penalty>
 */
class PenaltyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['fine', 'accident']),
            'received_at' => fake()->dateTimeBetween('-4 month', '-1 month')->format('Y-m-d H:i:s'),
            'paid_at' => fake()->dateTimeBetween('-2 month', 'now')->format('Y-m-d H:i:s'),
            'amount' => random_int(10000, 200000),
            'status' => fake()->randomElement(['unpaid', 'paid_with_discount', 'paid_without_discount']),
        ];
    }
}

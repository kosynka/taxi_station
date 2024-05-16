<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rent>
 */
class RentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'car_id' => random_int(1, 73),
            'driver_id' => random_int(1, 48),
            'start_at' => fake()->dateTimeBetween('-2 days', 'now')->format('Y-m-d H:i:s'),
            'end_at' => null,
            'amount' => null,
        ];
    }
}

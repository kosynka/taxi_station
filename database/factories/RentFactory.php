<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Car;
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
        $car = Car::query()
            ->inRandomOrder()
            ->first();

        $startDate = fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d');

        if ($startDate === now()->format('Y-m-d')) {
            $car->status = Car::ON_RENT;
            $car->save();
        }

        return [
            'car_id' => $car->id,
            'driver_id' => random_int(2, 48),
            'start_at' => $startDate,
            'amount' => $car->amount,
        ];
    }
}

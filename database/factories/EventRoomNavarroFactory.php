<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventRoomNavarroFactory extends Factory
{
    protected $model = \App\Models\EventRoomNavarro::class;

    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Grand Ballroom', 'Sky Lounge', 'Garden Pavilion', 'Conference Hall A', 'Rooftop Deck', 'Executive Suite']) . ' ' . fake()->numberBetween(1, 99),
            'type' => fake()->randomElement(['event', 'room']),
            'location' => fake()->city(),
            'capacity' => fake()->numberBetween(10, 100),
            'description' => fake()->sentence(12),
            'is_active' => true,
        ];
    }
}
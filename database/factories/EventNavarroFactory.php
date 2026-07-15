<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventNavarroFactory extends Factory
{
    protected $model = \App\Models\EventNavarro::class;

    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Wedding Reception', 'Birthday Party', 'Corporate Seminar',
                'Product Launch', 'Anniversary Celebration', 'Conference',
                'Graduation Party', 'Team Building', 'Charity Gala',
            ]),
            'description' => fake()->sentence(10),
            'is_active' => true,
        ];
    }
}
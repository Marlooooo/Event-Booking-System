<?php

namespace Database\Factories;

use App\Models\EventRoomNavarro;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingNavarroFactory extends Factory
{
    protected $model = \App\Models\BookingNavarro::class;

    public function definition(): array
    {
        return [
            'customer_name' => fake()->name(),
            'event_room_navarro_id' => EventRoomNavarro::factory(),
            'booking_date' => fake()->dateTimeBetween('now', '+2 months')->format('Y-m-d'),
            'booking_id' => strtoupper(fake()->bothify('????####')),
            'num_persons' => fake()->numberBetween(1, 100),
            'confirmation_original_name' => 'sample-confirmation.pdf',
            'confirmation_stored_name' => 'sample_' . fake()->uuid() . '.pdf',
            'confirmation_path' => 'bookings/sample_' . fake()->uuid() . '.pdf',
            'confirmation_mime' => 'application/pdf',
        ];
    }
}
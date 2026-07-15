<?php

namespace Database\Seeders;

use App\Models\BookingNavarro;
use App\Models\EventRoomNavarro;
use Illuminate\Database\Seeder;

class BookingNavarroSeeder extends Seeder
{
    public function run(): void
    {
        // Attach bookings to existing events/rooms instead of creating new ones.
        EventRoomNavarro::all()->each(function ($eventRoom) {
            BookingNavarro::factory()
                ->count(rand(1, 3))
                ->create(['event_room_navarro_id' => $eventRoom->id]);
        });
    }
}
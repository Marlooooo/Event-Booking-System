<?php

namespace Database\Seeders;

use App\Models\EventRoomNavarro;
use Illuminate\Database\Seeder;

class EventRoomNavarroSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            [
                'name' => 'ABC Hall',
                'type' => 'Room',
                'location' => 'Dagupan City, Pangasinan',
                'capacity' => 27,
                'description' => 'Fully air-conditioned function hall for weddings, birthdays, and seminars.',
                'is_active' => true,
            ],
            [
                'name' => 'CSI Stadia Function Hall',
                'type' => 'Room',
                'location' => 'Lucao, Dagupan City',
                'capacity' => 31,
                'description' => 'Large indoor venue for corporate and social events.',
                'is_active' => true,
            ],
            [
                'name' => 'Lenox Hotel Ballroom',
                'type' => 'Room',
                'location' => 'Dagupan City',
                'capacity' => 38,
                'description' => 'Hotel ballroom suitable for receptions and conferences.',
                'is_active' => true,
            ],
            [
                'name' => 'People\'s Astrodome',
                'type' => 'Room',
                'location' => 'Dagupan City',
                'capacity' => 67,
                'description' => 'Multi-purpose indoor venue for large events.',
                'is_active' => true,
            ],
            [
                'name' => 'Bonuan Blue Beach Grounds',
                'type' => 'Outdoor',
                'location' => 'Bonuan, Dagupan City',
                'capacity' => 99,
                'description' => 'Open beachside venue for parties and festivals.',
                'is_active' => true,
            ],
            [
                'name' => 'Tondaligan Park Pavilion',
                'type' => 'Outdoor',
                'location' => 'Tondaligan, Dagupan City',
                'capacity' => 98,
                'description' => 'Covered outdoor pavilion for family gatherings.',
                'is_active' => true,
            ],
            [
                'name' => 'Dagupan City Plaza',
                'type' => 'Outdoor',
                'location' => 'Downtown Dagupan City',
                'capacity' => 91,
                'description' => 'Open public venue for community events.',
                'is_active' => true,
            ],
            [
                'name' => 'Pangasinan Training Center',
                'type' => 'Room',
                'location' => 'Dagupan City',
                'capacity' => 46,
                'description' => 'Conference and seminar venue.',
                'is_active' => true,
            ],
            [
                'name' => 'Nepo Mall Event Center',
                'type' => 'Room',
                'location' => 'Arellano Street, Dagupan City',
                'capacity' => 50,
                'description' => 'Indoor event center suitable for exhibits, seminars, and private functions.',
                'is_active' => true,
            ],
            [
                'name' => 'Villa Milagros Garden',
                'type' => 'Outdoor',
                'location' => 'Calmay, Dagupan City',
                'capacity' => 65,
                'description' => 'Garden venue ideal for weddings, birthdays, and family gatherings.',
                'is_active' => true,
            ],
            [
                'name' => 'Universidad de Dagupan Convention Hall',
                'type' => 'Room',
                'location' => 'Arellano Street, Dagupan City',
                'capacity' => 53,
                'description' => 'Multi-purpose convention hall for conferences, graduations, and large events.',
                'is_active' => true,
            ],
        ];

        foreach ($rooms as $room) {
            EventRoomNavarro::create($room);
        }
    }
}
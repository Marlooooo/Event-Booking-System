<?php

namespace Database\Seeders;

use App\Models\EventNavarro;
use Illuminate\Database\Seeder;

class EventNavarroSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Wedding Reception', 'Birthday Party', 'Corporate Seminar',
            'Product Launch', 'Anniversary Celebration', 'Conference',
            'Graduation Party', 'Team Building', 'Charity Gala',
        ];

        foreach ($names as $name) {
            EventNavarro::create([
                'name' => $name,
                'description' => $name . ' hosted at your chosen venue.',
                'is_active' => true,
            ]);
        }
    }
}
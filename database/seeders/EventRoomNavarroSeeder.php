<?php

namespace Database\Seeders;

use App\Models\EventRoomNavarro;
use Illuminate\Database\Seeder;

class EventRoomNavarroSeeder extends Seeder
{
    public function run(): void
    {
        EventRoomNavarro::factory()->count(8)->create();
    }
}
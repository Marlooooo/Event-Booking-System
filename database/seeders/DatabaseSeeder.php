<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminNavarroSeeder::class,
            EventRoomNavarroSeeder::class,
            EventNavarroSeeder::class,
        ]);
        User::factory()->create([
            'name' => 'Marlo S. Navarro',
            'email' => 'marloN@lotlotevent.com',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminNavarroSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'marlotlotAdmin@lotlot.com'],
            [
                'name' => 'Lotlot Admin',
                'email' => 'marlotlotAdmin@lotlot.com',
                'password' => Hash::make('12345'),
                'role' => 'admin',
            ]
        );
    }
}
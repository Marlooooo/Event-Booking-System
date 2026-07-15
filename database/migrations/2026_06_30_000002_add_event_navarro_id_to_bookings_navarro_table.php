<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings_navarro', function (Blueprint $table) {
            $table->foreignId('event_navarro_id')
                ->nullable()
                ->after('event_room_navarro_id')
                ->constrained('events_navarro')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('bookings_navarro', function (Blueprint $table) {
            $table->dropForeign(['event_navarro_id']);
            $table->dropColumn('event_navarro_id');
        });
    }
};
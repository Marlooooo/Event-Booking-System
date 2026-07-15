<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings_navarro', function (Blueprint $table) {
            $table->foreignId('event_room_navarro_id')
                ->after('customer_name')
                ->constrained('events_rooms_navarro')
                ->onDelete('cascade');

            $table->date('booking_date')->after('event_room_navarro_id');

            $table->dropColumn('event_name');
        });
    }

    public function down(): void
    {
        Schema::table('bookings_navarro', function (Blueprint $table) {
            $table->dropForeign(['event_room_navarro_id']);
            $table->dropColumn(['event_room_navarro_id', 'booking_date']);
            $table->string('event_name')->nullable();
        });
    }
};
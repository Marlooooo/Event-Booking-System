<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings_navarro', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('booking_id', 8)->unique();
            $table->string('event_name');
            $table->unsignedInteger('num_persons');
            $table->string('confirmation_original_name');
            $table->string('confirmation_stored_name');
            $table->string('confirmation_path');
            $table->string('confirmation_mime');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings_navarro');
    }
};
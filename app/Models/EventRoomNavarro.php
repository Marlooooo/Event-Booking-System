<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventRoomNavarro extends Model
{
    use HasFactory;

    protected $table = 'events_rooms_navarro';

    protected $fillable = [
        'name', 'type', 'location', 'capacity', 'description', 'is_active',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(BookingNavarro::class, 'event_room_navarro_id');
    }

    public function isBookedOn(string $date): bool
    {
        return $this->bookings()->where('booking_date', $date)->exists();
    }
}
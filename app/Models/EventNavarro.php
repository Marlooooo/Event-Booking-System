<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventNavarro extends Model
{
    use HasFactory;

    protected $table = 'events_navarro';

    protected $fillable = ['name', 'description', 'is_active'];

    public function bookings(): HasMany
    {
        return $this->hasMany(BookingNavarro::class, 'event_navarro_id');
    }
}

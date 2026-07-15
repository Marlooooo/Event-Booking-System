<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingNavarro extends Model
{
    use HasFactory;

    protected $table = 'bookings_navarro';

    protected $fillable = [
        'user_id',
        'customer_name',
        'event_room_navarro_id',
        'event_navarro_id',
        'booking_date',
        'booking_id',
        'num_persons',
        'confirmation_original_name',
        'confirmation_stored_name',
        'confirmation_path',
        'confirmation_mime',
        'status',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function eventRoom(): BelongsTo
    {
        return $this->belongsTo(EventRoomNavarro::class, 'event_room_navarro_id');
    }

    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventNavarro::class, 'event_navarro_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isImage(): bool
    {
        return in_array($this->confirmation_mime, ['image/jpeg', 'image/png', 'image/jpg']);
    }

    public function statusBadge(): string
    {
        return match ($this->status) {
            'accepted' => '✅ Accepted',
            'rejected' => '❌ Rejected',
            default => '⏳ Pending',
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'accepted' => '#166534',
            'rejected' => '#991b1b',
            default => '#92400e',
        };
    }

    public function statusBg(): string
    {
        return match ($this->status) {
            'accepted' => '#dcfce7',
            'rejected' => '#fee2e2',
            default => '#fef3c7',
        };
    }
}
@extends('layouts.admin-form-navarro')
@section('title', 'Venue Detail — Lotlot Event Booking')
@section('breadcrumb-current', $eventRoomNavarro->name)
@section('breadcrumb-parent')
    <a href="{{ route('events-rooms.index') }}" style="color:#94a3b8;text-decoration:none;font-weight:600;">Venues</a>
@endsection

@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="eyebrow">Venue Detail</div>
        <h1>{{ $eventRoomNavarro->name }}</h1>
        <p>
            <span class="badge-type {{ $eventRoomNavarro->type }}">{{ ucfirst($eventRoomNavarro->type) }}</span>
            &nbsp;&middot;&nbsp;
            <span class="badge-active {{ $eventRoomNavarro->is_active ? 'yes' : 'no' }}">
                {{ $eventRoomNavarro->is_active ? 'Active' : 'Inactive' }}
            </span>
        </p>
    </div>
    <div style="display:flex;gap:10px;">
        <a href="{{ route('events-rooms.index') }}" class="btn-cancel">Back</a>
        <a href="{{ route('events-rooms.edit', $eventRoomNavarro) }}" class="btn-submit">Edit Venue</a>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;max-width:100%;">

    {{-- Venue info card --}}
    <div class="form-card" style="max-width:100%;">
        <div class="form-card-header">
            <div class="card-icon">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <div>
                <div class="card-title">Venue Details</div>
                <div class="card-subtitle">General information</div>
            </div>
        </div>
        <div class="form-card-body" style="padding:0;">
            <table style="width:100%;font-size:13.5px;border-collapse:collapse;">
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:14px 20px;color:#94a3b8;font-weight:700;font-size:11.5px;text-transform:uppercase;letter-spacing:0.5px;width:38%;">Location</td>
                    <td style="padding:14px 20px;font-weight:600;color:#0f172a;">{{ $eventRoomNavarro->location ?? '—' }}</td>
                </tr>
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:14px 20px;color:#94a3b8;font-weight:700;font-size:11.5px;text-transform:uppercase;letter-spacing:0.5px;">Capacity</td>
                    <td style="padding:14px 20px;font-weight:700;color:#0f172a;font-size:18px;">{{ $eventRoomNavarro->capacity }} <span style="font-size:13px;color:#94a3b8;font-weight:500;">persons</span></td>
                </tr>
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:14px 20px;color:#94a3b8;font-weight:700;font-size:11.5px;text-transform:uppercase;letter-spacing:0.5px;">Total Bookings</td>
                    <td style="padding:14px 20px;font-weight:700;color:#4f46e5;font-size:18px;">{{ $eventRoomNavarro->bookings->count() }}</td>
                </tr>
                <tr>
                    <td style="padding:14px 20px;color:#94a3b8;font-weight:700;font-size:11.5px;text-transform:uppercase;letter-spacing:0.5px;">Description</td>
                    <td style="padding:14px 20px;color:#374151;line-height:1.6;">{{ $eventRoomNavarro->description ?? '—' }}</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Bookings card --}}
    <div class="form-card" style="max-width:100%;">
        <div class="form-card-header">
            <div class="card-icon">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div>
                <div class="card-title">Recent Bookings</div>
                <div class="card-subtitle">Latest reservations for this venue</div>
            </div>
        </div>
        <div class="form-card-body" style="padding:0;">
            @forelse ($eventRoomNavarro->bookings->sortByDesc('booking_date')->take(6) as $booking)
                <div style="display:flex;justify-content:space-between;align-items:center;padding:13px 20px;border-bottom:1px solid #f1f5f9;">
                    <div>
                        <div style="font-size:13.5px;font-weight:700;color:#0f172a;">{{ $booking->customer_name }}</div>
                        <div style="font-size:12px;color:#94a3b8;margin-top:2px;">
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}
                            &middot; {{ $booking->num_persons }} pax
                        </div>
                    </div>
                    <span style="padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;
                        background:{{ $booking->statusBg() }};color:{{ $booking->statusColor() }};">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
            @empty
                <div style="padding:36px;text-align:center;color:#94a3b8;font-size:13.5px;font-weight:600;">
                    No bookings for this venue yet.
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
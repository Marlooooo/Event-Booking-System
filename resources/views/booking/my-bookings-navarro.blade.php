@extends('layouts.app-navarro')
@section('title', 'My Bookings')
@section('step1class', 'done')
@section('step2class', 'done')
@section('step3class', 'done')
@section('step4class', 'done')
@section('step5class', 'active')
@section('content')
    <h1>My Bookings</h1>
    <p class="subtitle">All bookings made under the name <strong>{{ $customerName }}</strong>.</p>

    @forelse ($bookings as $booking)
        <div class="summary-row" style="flex-direction:column; align-items:flex-start; gap:8px; padding:18px 0;">
            <div style="display:flex; justify-content:space-between; width:100%;">
                <strong>{{ $booking->eventRoom->name ?? 'Deleted Event/Room' }}</strong>
                <span>{{ $booking->booking_date->format('M d, Y') }}</span>
            </div>
            <div style="color:#6b7280; font-size:13px;">
                Booking ID: {{ $booking->booking_id }} &nbsp;•&nbsp; {{ $booking->num_persons }} pax
            </div>
            <div class="btn-row">
                <a class="btn btn-outline" href="{{ route('booking.my-bookings.edit', $booking) }}">Edit</a>
                <form method="POST" action="{{ route('booking.my-bookings.cancel', $booking) }}" onsubmit="return confirm('Cancel this booking? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-secondary">Cancel Booking</button>
                </form>
            </div>
        </div>
    @empty
        <p class="subtitle">You don't have any bookings yet.</p>
    @endforelse

    <div class="btn-row" style="margin-top:20px;">
        <a class="btn btn-outline" href="{{ route('booking.start') }}">← Back to Start</a>
        <a class="btn" href="{{ route('booking.details') }}">+ New Booking</a>
    </div>
@endsection
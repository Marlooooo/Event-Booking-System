@extends('layouts.admin-navarro')
@section('title', 'All Bookings')
@section('content')
    <h1>All Bookings</h1>

    <div class="btn-row" style="margin-bottom:20px; margin-top:0;">
        <a class="btn btn-outline {{ $status === 'all' ? 'active-filter' : '' }}" href="{{ route('admin.bookings.navarro') }}">All</a>
        <a class="btn btn-outline {{ $status === 'pending' ? 'active-filter' : '' }}" href="{{ route('admin.bookings.navarro', ['status' => 'pending']) }}">Pending</a>
        <a class="btn btn-outline {{ $status === 'accepted' ? 'active-filter' : '' }}" href="{{ route('admin.bookings.navarro', ['status' => 'accepted']) }}">Accepted</a>
        <a class="btn btn-outline {{ $status === 'rejected' ? 'active-filter' : '' }}" href="{{ route('admin.bookings.navarro', ['status' => 'rejected']) }}">Rejected</a>
    </div>

    @forelse ($bookings as $booking)
        <div class="booking-row">
            <div>
                <strong>{{ $booking->customer_name }}</strong>
                <span class="meta">{{ $booking->eventRoom->name ?? '—' }} · {{ $booking->eventType->name ?? '—' }} · {{ $booking->booking_date->format('M d, Y') }} · {{ $booking->num_persons }} pax</span>
            </div>
            <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                <span class="badge" style="background:{{ $booking->statusBg() }}; color:{{ $booking->statusColor() }};">{{ $booking->statusBadge() }}</span>
                <a class="btn-sm" href="{{ route('admin.booking.show.navarro', $booking) }}">View</a>
                @if ($booking->status === 'pending')
                    <form method="POST" action="{{ route('admin.booking.accept.navarro', $booking) }}">
                        @csrf @method('PATCH')
                        <button class="btn-sm accept">Accept</button>
                    </form>
                    <form method="POST" action="{{ route('admin.booking.reject.navarro', $booking) }}">
                        @csrf @method('PATCH')
                        <button class="btn-sm reject">Reject</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p class="subtitle">No bookings found.</p>
    @endforelse
@endsection
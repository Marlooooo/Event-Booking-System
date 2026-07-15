@extends('layouts.admin-navarro')
@section('title', 'Booking Detail')
@section('content')
    <h1>Booking #{{ $bookingNavarro->booking_id }}</h1>
    <p class="subtitle">
        <span class="badge" style="background:{{ $bookingNavarro->statusBg() }}; color:{{ $bookingNavarro->statusColor() }}; padding:5px 14px; border-radius:20px; font-size:13px;">
            {{ $bookingNavarro->statusBadge() }}
        </span>
    </p>

    <div class="summary-row"><span>Customer</span><strong>{{ $bookingNavarro->customer_name }}</strong></div>
    <div class="summary-row"><span>Email</span><strong>{{ $bookingNavarro->user->email ?? '—' }}</strong></div>
    <div class="summary-row"><span>Venue</span><strong>{{ $bookingNavarro->eventRoom->name ?? '—' }}</strong></div>
    <div class="summary-row"><span>Event Type</span><strong>{{ $bookingNavarro->eventType->name ?? '—' }}</strong></div>
    <div class="summary-row"><span>Date</span><strong>{{ $bookingNavarro->booking_date->format('F d, Y') }}</strong></div>
    <div class="summary-row"><span>Persons</span><strong>{{ $bookingNavarro->num_persons }}</strong></div>
    <div class="summary-row"><span>File</span><strong>{{ $bookingNavarro->confirmation_original_name }}</strong></div>

    @if ($bookingNavarro->isImage())
        <img class="preview" src="{{ asset('storage/' . $bookingNavarro->confirmation_path) }}">
    @endif

    @if ($bookingNavarro->status === 'pending')
        <div class="btn-row" style="margin-top:24px;">
            <form method="POST" action="{{ route('admin.booking.accept.navarro', $bookingNavarro) }}">
                @csrf @method('PATCH')
                <button class="btn" style="background:linear-gradient(135deg,#16a34a,#15803d);">✅ Accept Booking</button>
            </form>
            <form method="POST" action="{{ route('admin.booking.reject.navarro', $bookingNavarro) }}">
                @csrf @method('PATCH')
                <button class="btn" style="background:linear-gradient(135deg,#dc2626,#b91c1c);">❌ Reject Booking</button>
            </form>
        </div>
    @endif

    <a class="btn btn-outline" href="{{ route('admin.bookings.navarro') }}" style="margin-top:12px;">← Back to Bookings</a>
@endsection
@extends('layouts.app-navarro')
@section('title', 'Booking Summary')
@section('step1class', 'done')
@section('step2class', 'done')
@section('step3class', 'done')
@section('step4class', 'active')
@section('content')
    <h1>Booking Summary</h1>
    <p class="subtitle">Here's everything we've got on file. 🎉</p>

    <div class="summary-row"><span>Customer Name</span><strong>{{ $booking->customer_name }}</strong></div>
<div class="summary-row"><span>Venue</span><strong>{{ $booking->eventRoom->name }}</strong></div>
    <div class="summary-row"><span>Event Type</span><strong>{{ $booking->eventType->name ?? '—' }}</strong></div>
    <div class="summary-row"><span>Location</span><strong>{{ $booking->eventRoom->location ?? '—' }}</strong></div>
    <div class="summary-row"><span>Booking Date</span><strong>{{ $booking->booking_date->format('M d, Y') }}</strong></div>
    <div class="summary-row"><span>Booking ID</span><strong>{{ $booking->booking_id }}</strong></div>
    <div class="summary-row"><span>Number of Persons</span><strong>{{ $booking->num_persons }}</strong></div>
    <div class="summary-row"><span>Uploaded File</span><strong>{{ $booking->confirmation_original_name }}</strong></div>

    @if ($isImage)
        <p style="margin-top:20px;"><strong>Preview:</strong></p>
        <img class="preview" src="{{ asset('storage/' . $booking->confirmation_path) }}">
    @else
        <p style="margin-top:20px;">
            <a class="btn" href="{{ route('booking.file', $booking->confirmation_stored_name) }}">Download PDF</a>
        </p>
    @endif

    <div class="btn-row" style="margin-top:8px;">
        <a class="btn btn-outline" href="{{ route('booking.confirmation') }}">← Back</a>
        <a class="btn btn-outline" href="{{ route('booking.my-bookings') }}">View My Bookings</a>
        <form method="POST" action="{{ route('booking.reset') }}">
            @csrf
            <button type="submit" class="btn-secondary">Start a New Booking</button>
        </form>
    </div>
@endsection
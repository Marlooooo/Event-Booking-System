@extends('layouts.app-navarro')
@section('title', 'All Bookings')
@section('content')
    <h1>All Bookings</h1>
    @foreach ($bookings as $booking)
        <div class="summary-row">
            <span>{{ $booking->customer_name }} — {{ $booking->eventRoom->name }} ({{ $booking->booking_date->format('M d, Y') }})</span>
            <span class="btn-row">
                <a class="btn btn-outline" href="{{ route('bookings.show', $booking) }}">View</a>
                <a class="btn btn-outline" href="{{ route('bookings.edit', $booking) }}">Edit</a>
                <form method="POST" action="{{ route('bookings.destroy', $booking) }}" onsubmit="return confirm('Delete this booking?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-secondary">Delete</button>
                </form>
            </span>
        </div>
    @endforeach
@endsection
@extends('layouts.app-navarro')
@section('title', 'Booking Details')
@section('content')
    <h1>Booking #{{ $bookingNavarro->booking_id }}</h1>
    <div class="summary-row"><span>Customer</span><strong>{{ $bookingNavarro->customer_name }}</strong></div>
    <div class="summary-row"><span>Event/Room</span><strong>{{ $bookingNavarro->eventRoom->name }}</strong></div>
    <div class="summary-row"><span>Date</span><strong>{{ $bookingNavarro->booking_date->format('M d, Y') }}</strong></div>
    <div class="summary-row"><span>Persons</span><strong>{{ $bookingNavarro->num_persons }}</strong></div>
    <a class="btn btn-outline" href="{{ route('bookings.index') }}" style="margin-top:20px;">← Back to list</a>
@endsection
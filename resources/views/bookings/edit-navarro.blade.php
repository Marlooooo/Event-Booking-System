@extends('layouts.app-navarro')
@section('title', 'Edit Booking')
@section('content')
    <h1>Edit Booking</h1>
    <form method="POST" action="{{ route('bookings.update', $bookingNavarro) }}">
        @csrf @method('PUT')
        <label>Customer Name</label>
        <input type="text" name="customer_name" value="{{ old('customer_name', $bookingNavarro->customer_name) }}">
        @error('customer_name')<div class="field-error">{{ $message }}</div>@enderror

        <label>Venue</label>
        <select name="event_room_navarro_id" style="width:100%; padding:12px; border-radius:10px; border:1.5px solid #e5e7eb;">
            @foreach ($eventsRooms as $item)
                <option value="{{ $item->id }}" {{ old('event_room_navarro_id', $bookingNavarro->event_room_navarro_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
        </select>
        @error('event_room_navarro_id')<div class="field-error">{{ $message }}</div>@enderror

        <label>Event Type</label>
        <select name="event_navarro_id" style="width:100%; padding:12px; border-radius:10px; border:1.5px solid #e5e7eb;">
            @foreach ($events as $event)
                <option value="{{ $event->id }}" {{ old('event_navarro_id', $bookingNavarro->event_navarro_id) == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
            @endforeach
        </select>
        @error('event_navarro_id')<div class="field-error">{{ $message }}</div>@enderror

        <label>Booking Date</label>
        <input type="date" name="booking_date" value="{{ old('booking_date', $bookingNavarro->booking_date->format('Y-m-d')) }}">
        @error('booking_date')<div class="field-error">{{ $message }}</div>@enderror

        <label>Number of Persons</label>
        <input type="number" name="num_persons" min="1" max="100" value="{{ old('num_persons', $bookingNavarro->num_persons) }}">
        @error('num_persons')<div class="field-error">{{ $message }}</div>@enderror

        <button type="submit">Update</button>
    </form>
@endsection
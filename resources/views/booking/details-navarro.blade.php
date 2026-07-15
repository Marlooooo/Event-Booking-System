@extends('layouts.app-navarro')
@section('title', 'Booking Details')
@section('step1class', 'done')
@section('step2class', 'active')
@section('content')
    <h1>Booking Details</h1>
    <p class="subtitle">Choose your venue and the type of event.</p>
    <form method="POST" action="{{ route('booking.details.store') }}">
        @csrf
        <label>Customer Name</label>
        <input type="text" value="{{ $customerName }}" readonly>

        <label>Venue</label>
        <select name="event_room_navarro_id" style="width:100%; padding:12px 14px; border:1.5px solid #e5e7eb; border-radius:10px; font-size:14.5px; background:#fafafa;">
            <option value="">— Select a venue —</option>
            @foreach ($venues as $venue)
                <option value="{{ $venue->id }}" {{ old('event_room_navarro_id', $old['event_room_navarro_id'] ?? '') == $venue->id ? 'selected' : '' }}>
                    {{ $venue->name }} ({{ $venue->location ?? 'No location set' }} — max {{ $venue->capacity }} pax)
                </option>
            @endforeach
        </select>
        @error('event_room_navarro_id')<div class="field-error">{{ $message }}</div>@enderror

        <label>Event Type</label>
        <select name="event_navarro_id" style="width:100%; padding:12px 14px; border:1.5px solid #e5e7eb; border-radius:10px; font-size:14.5px; background:#fafafa;">
            <option value="">— Select an event —</option>
            @foreach ($events as $event)
                <option value="{{ $event->id }}" {{ old('event_navarro_id', $old['event_navarro_id'] ?? '') == $event->id ? 'selected' : '' }}>
                    {{ $event->name }}
                </option>
            @endforeach
        </select>
        @error('event_navarro_id')<div class="field-error">{{ $message }}</div>@enderror

        <label>Booking Date</label>
        <input type="date" name="booking_date" value="{{ old('booking_date', $old['booking_date'] ?? '') }}" min="{{ date('Y-m-d') }}">
        @error('booking_date')<div class="field-error">{{ $message }}</div>@enderror

        <label>Number of Persons (max 100)</label>
        <input type="number" name="num_persons" min="1" max="100" value="{{ old('num_persons', $old['num_persons'] ?? '') }}">
        @error('num_persons')<div class="field-error">{{ $message }}</div>@enderror

        <div class="btn-row">
            <a class="btn btn-outline" href="{{ route('customer.dashboard.navarro') }}">← Dashboard</a>
            <a class="btn btn-outline" href="{{ route('booking.start') }}">← Back</a>
            <button type="submit">Continue →</button>
        </div>
    </form>
@endsection
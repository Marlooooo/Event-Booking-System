@extends('layouts.app-navarro')
@section('title', 'Edit My Booking')
@section('step1class', 'done')
@section('step2class', 'done')
@section('step3class', 'done')
@section('step4class', 'done')
@section('step5class', 'active')
@section('content')
    <h1>Edit Booking</h1>
    <p class="subtitle">Update your booking details below.</p>

    <form method="POST" action="{{ route('booking.my-bookings.update', $bookingNavarro) }}">
        @csrf
        @method('PUT')

        <label>Venue</label>
        <select
            id="venue"
            name="event_room_navarro_id"
            style="width:100%; padding:12px 14px; border:1.5px solid #e5e7eb; border-radius:10px; font-size:14.5px; background:#fafafa;">
                @foreach ($eventsRooms as $item)
                <option
                    value="{{ $item->id }}"
                    data-capacity="{{ $item->capacity }}"
                    {{ old('event_room_navarro_id', $bookingNavarro->event_room_navarro_id) == $item->id ? 'selected' : '' }}>
                    {{ $item->name }} ({{ ucfirst($item->location) }} - max {{ $item->capacity }} pax)
                </option>
            @endforeach
        </select>


        @error('event_room_navarro_id')<div class="field-error">{{ $message }}</div>@enderror

        <label>Event Type</label>
        <select
            name="event_navarro_id"
            style="width:100%; padding:12px 14px; border:1.5px solid #e5e7eb; border-radius:10px; font-size:14.5px; background:#fafafa;">

            @foreach ($events as $event)
                <option
                    value="{{ $event->id }}"
                    {{ old('event_navarro_id', $bookingNavarro->event_navarro_id) == $event->id ? 'selected' : '' }}>
                    {{ $event->name }}
                </option>
            @endforeach

        </select>
        @error('event_navarro_id')<div class="field-error">{{ $message }}</div>@enderror

        <label>Booking Date</label>
        <input type="date" name="booking_date" value="{{ old('booking_date', $bookingNavarro->booking_date->format('Y-m-d')) }}" min="{{ date('Y-m-d') }}">
        @error('booking_date')<div class="field-error">{{ $message }}</div>@enderror

        <label id="personsLabel">Number of Persons</label>
        <input
            type="number"
            id="num_persons"
            name="num_persons"
            min="1"
            value="{{ old('num_persons', $bookingNavarro->num_persons) }}">

        @error('num_persons')<div class="field-error">{{ $message }}</div>@enderror

        <div class="btn-row">
            <a class="btn btn-outline" href="{{ route('customer.dashboard.navarro') }}">
                &#8592; Dashboard
            </a>
            <a class="btn btn-outline" href="{{ route('booking.my-bookings') }}">← Back</a>
            <button type="submit">Save Changes</button>
        </div>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const venue = document.getElementById('venue');
        const persons = document.getElementById('num_persons');
        const label = document.getElementById('personsLabel');

        function updateCapacity() {

            const option = venue.options[venue.selectedIndex];

            if (!option.dataset.capacity) return;

            const capacity = option.dataset.capacity;

            persons.max = capacity;
            label.textContent = `Number of Persons (max ${capacity})`;

            if (persons.value > capacity) {
                persons.value = capacity;
            }
        }

        venue.addEventListener('change', updateCapacity);

        updateCapacity();
    });
    </script>
@endsection
@extends('layouts.admin-form-navarro')
@section('title', 'Add Venue — Lotlot Event Booking')
@section('breadcrumb-current', 'Add New Venue')
@section('breadcrumb-parent')
    <a href="{{ route('events-rooms.index') }}" style="color:#94a3b8;text-decoration:none;font-weight:600;">Venues</a>
@endsection

@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="eyebrow">Venues</div>
        <h1>Add New Venue</h1>
        <p>Fill in the details below to register a new venue or room.</p>
    </div>
    <a href="{{ route('events-rooms.index') }}" class="btn-cancel">
        Back to Venues
    </a>
</div>

<form method="POST" action="{{ route('events-rooms.store') }}">
    @csrf

    <div class="form-card">
        <div class="form-card-header">
            <div class="card-icon">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <div>
                <div class="card-title">Venue Information</div>
                <div class="card-subtitle">Basic details about this venue</div>
            </div>
        </div>

        <div class="form-card-body">

            <div class="form-row">
                <div class="form-group">
                    <label>Venue Name</label>
                    <span class="hint">The display name customers will see</span>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Grand Ballroom">
                    @error('name')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <span class="hint">Classify this as a room or event space</span>
                    <select name="type">
                        <option value="room"  {{ old('type') === 'room'  ? 'selected' : '' }}>Room</option>
                        <option value="event" {{ old('type') === 'event' ? 'selected' : '' }}>Event Space</option>
                    </select>
                    @error('type')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Location</label>
                    <span class="hint">Building, floor, or address</span>
                    <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g. 2nd Floor, North Wing">
                    @error('location')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Capacity</label>
                    <span class="hint">Maximum number of persons allowed</span>
                    <input type="number" name="capacity" value="{{ old('capacity') }}" placeholder="e.g. 50" min="1" max="1000">
                    @error('capacity')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-row single">
                <div class="form-group">
                    <label>Description</label>
                    <span class="hint">Optional — a short description shown on the booking form</span>
                    <textarea name="description" placeholder="Describe the venue, its features, or special notes...">{{ old('description') }}</textarea>
                    @error('description')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>

        </div>

        <div class="form-card-footer">
            <span class="footer-left">All fields marked are required except description.</span>
            <div class="footer-actions">
                <a href="{{ route('events-rooms.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">Save Venue</button>
            </div>
        </div>
    </div>

</form>

@endsection
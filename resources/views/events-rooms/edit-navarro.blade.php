@extends('layouts.admin-form-navarro')
@section('title', 'Edit Venue — Lotlot Event Booking')
@section('breadcrumb-current', 'Edit Venue')
@section('breadcrumb-parent')
    <a href="{{ route('events-rooms.index') }}" style="color:#94a3b8;text-decoration:none;font-weight:600;">Venues</a>
@endsection

@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="eyebrow">Venues</div>
        <h1>Edit Venue</h1>
        <p>Update the details for <strong>{{ $eventRoomNavarro->name }}</strong>.</p>
    </div>
    <a href="{{ route('events-rooms.index') }}" class="btn-cancel">Back to Venues</a>
</div>

<form method="POST" action="{{ route('events-rooms.update', $eventRoomNavarro) }}">
    @csrf
    @method('PUT')

    <div class="form-card">
        <div class="form-card-header">
            <div class="card-icon">
                <svg viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </div>
            <div>
                <div class="card-title">Edit Venue Information</div>
                <div class="card-subtitle">Changes will take effect immediately</div>
            </div>
        </div>

        <div class="form-card-body">

            <div class="form-row">
                <div class="form-group">
                    <label>Venue Name</label>
                    <span class="hint">The display name customers will see</span>
                    <input type="text" name="name" value="{{ old('name', $eventRoomNavarro->name) }}" placeholder="e.g. Grand Ballroom">
                    @error('name')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <span class="hint">Classify this as a room or event space</span>
                    <select name="type">
                        <option value="room"  {{ old('type', $eventRoomNavarro->type) === 'room'  ? 'selected' : '' }}>Room</option>
                        <option value="event" {{ old('type', $eventRoomNavarro->type) === 'event' ? 'selected' : '' }}>Event Space</option>
                    </select>
                    @error('type')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Location</label>
                    <span class="hint">Building, floor, or address</span>
                    <input type="text" name="location" value="{{ old('location', $eventRoomNavarro->location) }}" placeholder="e.g. 2nd Floor, North Wing">
                    @error('location')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Capacity</label>
                    <span class="hint">Maximum number of persons allowed</span>
                    <input type="number" name="capacity" value="{{ old('capacity', $eventRoomNavarro->capacity) }}" min="1" max="1000">
                    @error('capacity')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-row single">
                <div class="form-group">
                    <label>Description</label>
                    <span class="hint">Optional — a short description shown on the booking form</span>
                    <textarea name="description" placeholder="Describe the venue...">{{ old('description', $eventRoomNavarro->description) }}</textarea>
                    @error('description')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="section-divider"><span>Visibility</span></div>

            <div class="checkbox-row">
                <input type="checkbox" id="is_active" name="is_active" value="1"
                       {{ old('is_active', $eventRoomNavarro->is_active) ? 'checked' : '' }}>
                <label for="is_active">
                    Venue is active and available for booking
                </label>
            </div>

        </div>

        <div class="form-card-footer">
            <div>
                <form method="POST" action="{{ route('events-rooms.destroy', $eventRoomNavarro) }}"
                      onsubmit="return confirm('Delete this venue permanently?')" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Delete Venue</button>
                </form>
            </div>
            <div class="footer-actions">
                <a href="{{ route('events-rooms.index') }}" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">Save Changes</button>
            </div>
        </div>
    </div>

</form>

@endsection
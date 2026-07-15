@extends('layouts.admin-form-navarro')
@section('title', 'Venues — Lotlot Event Booking')
@section('breadcrumb-current', 'All Venues')
@section('breadcrumb-parent')
    <a href="{{ route('events-rooms.index') }}" style="color:#94a3b8;text-decoration:none;font-weight:600;">Venues</a>
@endsection
@section('content')

<div class="page-header">
    <div class="page-header-left">
        <div class="eyebrow">Management</div>
        <h1>Venues</h1>
        <p>All registered venues and rooms available for booking.</p>
    </div>
    <a href="{{ route('events-rooms.create') }}" class="btn-submit">
        Add New Venue
    </a>
</div>

<div class="form-card" style="max-width:100%;">
    <div class="form-card-header">
        <div class="card-icon">
            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <div>
            <div class="card-title">Venue List</div>
            <div class="card-subtitle">{{ $eventsRooms->count() }} venue{{ $eventsRooms->count() !== 1 ? 's' : '' }} registered</div>
        </div>
    </div>

    @if ($eventsRooms->isEmpty())
        <div style="padding:52px;text-align:center;">
            <div style="width:40px;height:2px;background:#e2e8f0;margin:0 auto 14px;"></div>
            <div style="font-size:14px;font-weight:600;color:#94a3b8;">No venues yet. Add your first one.</div>
        </div>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>Venue Name</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Capacity</th>
                    <th>Bookings</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventsRooms as $item)
                    <tr>
                        <td>
                            <div class="table-name">{{ $item->name }}</div>
                            @if ($item->description)
                                <div class="table-meta">{{ Str::limit($item->description, 60) }}</div>
                            @endif
                        </td>
                        <td>
                            <span class="badge-type {{ $item->type }}">{{ ucfirst($item->type) }}</span>
                        </td>
                        <td style="color:#64748b;">{{ $item->location ?? '—' }}</td>
                        <td style="font-weight:700;color:#0f172a;">{{ $item->capacity }} <span style="font-size:12px;color:#94a3b8;font-weight:500;">pax</span></td>
                        <td style="font-weight:700;color:#4f46e5;">{{ $item->bookings_count }}</td>
                        <td>
                            <span class="badge-active {{ $item->is_active ? 'yes' : 'no' }}">
                                {{ $item->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('events-rooms.show', $item) }}" class="tbl-btn">View</a>
                                <a href="{{ route('events-rooms.edit', $item) }}" class="tbl-btn">Edit</a>
                                <form method="POST" action="{{ route('events-rooms.destroy', $item) }}"
                                      onsubmit="return confirm('Delete {{ $item->name }}? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="tbl-btn danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
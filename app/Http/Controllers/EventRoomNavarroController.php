<?php

namespace App\Http\Controllers;

use App\Models\EventRoomNavarro;
use Illuminate\Http\Request;

class EventRoomNavarroController extends Controller
{
    public function index()
    {
        $eventsRooms = EventRoomNavarro::withCount('bookings')->latest()->get();

        return view('events-rooms.index-navarro', compact('eventsRooms'));
    }

    public function create()
    {
        return view('events-rooms.create-navarro');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'type' => ['required', 'in:event,room'],
            'location' => ['nullable', 'string', 'max:100'],
            'capacity' => ['required', 'integer', 'min:1', 'max:1000'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        EventRoomNavarro::create($validated);

        return redirect()->route('events-rooms.index')->with('success', 'Event/Room created successfully.');
    }

    // Route model binding: Laravel resolves {eventRoomNavarro} into an EventRoomNavarro instance automatically.
    public function show(EventRoomNavarro $eventRoomNavarro)
    {
        $eventRoomNavarro->load('bookings');

        return view('events-rooms.show-navarro', compact('eventRoomNavarro'));
    }

    public function edit(EventRoomNavarro $eventRoomNavarro)
    {
        return view('events-rooms.edit-navarro', compact('eventRoomNavarro'));
    }

    public function update(Request $request, EventRoomNavarro $eventRoomNavarro)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'type' => ['required', 'in:event,room'],
            'location' => ['nullable', 'string', 'max:100'],
            'capacity' => ['required', 'integer', 'min:1', 'max:1000'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $eventRoomNavarro->update($validated);

        return redirect()->route('events-rooms.index')->with('success', 'Event/Room updated successfully.');
    }

    public function destroy(EventRoomNavarro $eventRoomNavarro)
    {
        if ($eventRoomNavarro->bookings()->exists()) {
            return redirect()->route('events-rooms.index')
                ->with('error', 'Cannot delete — this event/room has existing bookings.');
        }

        $eventRoomNavarro->delete();

        return redirect()->route('events-rooms.index')->with('success', 'Event/Room deleted.');
    }
}
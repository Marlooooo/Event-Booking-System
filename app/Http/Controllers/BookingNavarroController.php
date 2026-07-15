<?php

namespace App\Http\Controllers;

use App\Models\BookingNavarro;
use App\Models\EventRoomNavarro;
use App\Models\EventNavarro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BookingNavarroController extends Controller
{
    /* ===================== ADMIN CRUD (resource) ===================== */

    public function index()
    {
        $bookings = BookingNavarro::with(['eventRoom', 'eventType'])->latest()->get();

        return view('bookings.index-navarro', compact('bookings'));
    }

    public function show(BookingNavarro $bookingNavarro)
    {
        $bookingNavarro->load(['eventRoom', 'eventType']);

        return view('bookings.show-navarro', compact('bookingNavarro'));
    }

    public function edit(BookingNavarro $bookingNavarro)
    {
        $eventsRooms = EventRoomNavarro::where('is_active', true)->get();
        $events = EventNavarro::where('is_active', true)->get();

        return view('bookings.edit-navarro', compact('bookingNavarro', 'eventsRooms', 'events'));
    }

    public function update(Request $request, BookingNavarro $bookingNavarro)
    {
        $validated = $request->validate([
            'customer_name'        => ['required', 'string', 'min:2', 'max:50', 'regex:/^[A-Za-z\s\.\'-]+$/'],
            'event_room_navarro_id'=> ['required', 'exists:events_rooms_navarro,id'],
            'event_navarro_id'     => ['required', 'exists:events_navarro,id'],
            'booking_date'         => ['required', 'date', 'after_or_equal:today'],
            'num_persons'          => ['required', 'integer', 'min:1', 'max:100'],
        ], $this->validationMessages());

        $conflict = $this->hasConflict(
            $validated['event_room_navarro_id'],
            $validated['booking_date'],
            $bookingNavarro->id
        );

        if ($conflict) {
            return back()->withErrors(['booking_date' => $conflict])->withInput();
        }

        $bookingNavarro->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(BookingNavarro $bookingNavarro)
    {
        if ($bookingNavarro->confirmation_path) {
            Storage::disk('public')->delete($bookingNavarro->confirmation_path);
        }

        $bookingNavarro->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted.');
    }

    /* ===================== PUBLIC MULTI-STEP WIZARD ===================== */

    public function start(Request $request)
    {
        // Already logged in — skip name entry, use their account name directly.
        if (auth()->check()) {
            session(['booking.customerName' => auth()->user()->name]);
            return redirect()->route('booking.details');
        }

        // Not logged in — send them to login first.
        return redirect()->route('login.navarro')
            ->with('error', 'Please log in to make a booking.');
    }

    public function storeStart(Request $request)
    {
        // Name always comes from the authenticated user — never from a form field.
        session(['booking.customerName' => auth()->user()->name]);

        return redirect()->route('booking.details');
    }

    public function showDetailsForm(Request $request)
    {
        $venues = EventRoomNavarro::where('is_active', true)->orderBy('name')->get();
        $events = EventNavarro::where('is_active', true)->orderBy('name')->get();

        return view('booking.details-navarro', [
            'customerName' => session('booking.customerName'),
            'venues'       => $venues,
            'events'       => $events,
            'old'          => session('booking.details', []),
        ]);
    }

    public function storeDetails(Request $request)
    {
        $validated = $request->validate([
            'event_room_navarro_id' => ['required', 'exists:events_rooms_navarro,id'],
            'event_navarro_id'      => ['required', 'exists:events_navarro,id'],
            'booking_date'          => ['required', 'date', 'after_or_equal:today'],
            'num_persons'           => ['required', 'integer', 'min:1', 'max:100'],
        ], $this->validationMessages());

        // Conflict check: same venue already booked on that date.
        $conflict = $this->hasConflict($validated['event_room_navarro_id'], $validated['booking_date']);

        if ($conflict) {
            return back()->withErrors(['booking_date' => $conflict])->withInput();
        }

        $validated['customer_name'] = session('booking.customerName');
        $validated['booking_id']    = $this->generateBookingId();

        session(['booking.details' => $validated]);

        return redirect()->route('booking.confirmation')
            ->with('success', 'Booking details saved. Please upload your confirmation document.');
    }

    public function showConfirmationForm(Request $request)
    {
        $details   = session('booking.details');
        $venue     = EventRoomNavarro::find($details['event_room_navarro_id']);
        $eventType = EventNavarro::find($details['event_navarro_id']);

        return view('booking.confirmation-navarro', compact('details', 'venue', 'eventType'));
    }

    public function storeConfirmation(Request $request)
    {
        $request->validate([
            'confirmation_file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        ], [
            'confirmation_file.required' => 'Please choose a confirmation file to upload.',
            'confirmation_file.mimes'    => 'Only PDF, JPG, and PNG files are allowed.',
            'confirmation_file.max'      => 'The file must not be larger than 2MB.',
        ]);

        $file         = $request->file('confirmation_file');
        $originalName = $file->getClientOriginalName();
        $storedName   = uniqid('booking_', true) . '.' . $file->getClientOriginalExtension();
        $path         = $file->storeAs('bookings', $storedName, 'public');

        $details = session('booking.details');

        // Final safety conflict check right before saving — in case another
        // user booked the same venue on the same date while this user was
        // still on the upload step.
        $conflict = $this->hasConflict($details['event_room_navarro_id'], $details['booking_date']);
        if ($conflict) {
            Storage::disk('public')->delete($path);
            return redirect()->route('booking.details')->with('error', $conflict);
        }

        $booking = BookingNavarro::create([
            'user_id'                    => auth()->id(),
            'customer_name'              => $details['customer_name'],
            'event_room_navarro_id'      => $details['event_room_navarro_id'],
            'event_navarro_id'           => $details['event_navarro_id'],
            'booking_date'               => $details['booking_date'],
            'booking_id'                 => $details['booking_id'],
            'num_persons'                => $details['num_persons'],
            'confirmation_original_name' => $originalName,
            'confirmation_stored_name'   => $storedName,
            'confirmation_path'          => $path,
            'confirmation_mime'          => $file->getClientMimeType(),
            'status'                     => 'pending',
        ]);

        session(['booking.confirmation' => true]);
        session(['booking.record_id'    => $booking->id]);

        return redirect()->route('booking.summary')
            ->with('success', 'File uploaded! Here is your booking summary.');
    }

    public function summary(Request $request)
    {
        $booking = BookingNavarro::with(['eventRoom', 'eventType'])
            ->findOrFail(session('booking.record_id'));

        return view('booking.summary-navarro', [
            'booking' => $booking,
            'isImage' => $booking->isImage(),
        ]);
    }

    public function downloadFile(Request $request, string $filename)
    {
        $booking = BookingNavarro::find(session('booking.record_id'));

        if (! $booking || $booking->confirmation_stored_name !== $filename) {
            abort(403, 'You are not allowed to access this file.');
        }

        return Storage::disk('public')->download(
            $booking->confirmation_path,
            $booking->confirmation_original_name
        );
    }

    public function reset(Request $request)
    {
        $request->session()->forget([
            'booking.customerName',
            'booking.details',
            'booking.confirmation',
            'booking.record_id',
        ]);

        return redirect()->route('booking.start')
            ->with('success', 'You can start a new booking now.');
    }

    /* ===================== STEP 5: MY BOOKINGS ===================== */

    public function myBookings(Request $request)
    {
        // Now matched by user_id (the logged-in user's real DB id),
        // not by session name string — much more reliable.
        $bookings = BookingNavarro::with(['eventRoom', 'eventType'])
            ->where('user_id', auth()->id())
            ->orderBy('booking_date', 'desc')
            ->get();

        $customerName = auth()->user()->name;

        return view('booking.my-bookings-navarro', compact('bookings', 'customerName'));
    }

    public function editMyBooking(BookingNavarro $bookingNavarro)
    {
        $this->authorizeOwnBooking($bookingNavarro);

        $eventsRooms = EventRoomNavarro::where('is_active', true)->orderBy('name')->get();
        $events      = EventNavarro::where('is_active', true)->orderBy('name')->get();

        return view('booking.my-bookings-edit-navarro', compact('bookingNavarro', 'eventsRooms', 'events'));
    }

    public function updateMyBooking(Request $request, BookingNavarro $bookingNavarro)
    {
        $this->authorizeOwnBooking($bookingNavarro);

        $validated = $request->validate([
            'event_room_navarro_id' => ['required', 'exists:events_rooms_navarro,id'],
            'event_navarro_id'      => ['required', 'exists:events_navarro,id'],
            'booking_date'          => ['required', 'date', 'after_or_equal:today'],
            'num_persons'           => ['required', 'integer', 'min:1', 'max:100'],
        ], $this->validationMessages());

        $conflict = $this->hasConflict(
            $validated['event_room_navarro_id'],
            $validated['booking_date'],
            $bookingNavarro->id
        );

        if ($conflict) {
            return back()->withErrors(['booking_date' => $conflict])->withInput();
        }

        $bookingNavarro->update($validated);

        return redirect()->route('booking.my-bookings')
            ->with('success', 'Your booking was updated successfully.');
    }

    public function cancelMyBooking(BookingNavarro $bookingNavarro)
    {
        $this->authorizeOwnBooking($bookingNavarro);

        if ($bookingNavarro->confirmation_path) {
            Storage::disk('public')->delete($bookingNavarro->confirmation_path);
        }

        $bookingNavarro->delete();

        return redirect()->route('booking.my-bookings')
            ->with('success', 'Your booking has been cancelled.');
    }

    /**
     * Make sure the booking being edited or cancelled actually belongs
     * to the currently authenticated user — prevents URL-guessing attacks.
     */
    private function authorizeOwnBooking(BookingNavarro $bookingNavarro): void
    {
        if ($bookingNavarro->user_id !== auth()->id()) {
            abort(403, 'You are not allowed to manage this booking.');
        }
    }

    /* ===================== SHARED HELPERS ===================== */

    /**
     * Returns an error string if the venue is already booked on the given
     * date (ignoring the current booking when editing), or null if free.
     */
    private function hasConflict(int $eventRoomId, string $date, ?int $ignoreBookingId = null): ?string
    {
        $eventRoom = EventRoomNavarro::find($eventRoomId);

        if (! $eventRoom) {
            return 'The selected venue no longer exists.';
        }

        $query = $eventRoom->bookings()->where('booking_date', $date);

        if ($ignoreBookingId) {
            $query->where('id', '!=', $ignoreBookingId);
        }

        if ($query->exists()) {
            return "Sorry, \"{$eventRoom->name}\" is already booked on {$date}. Please choose another date or a different venue.";
        }

        return null;
    }

    /**
     * Auto-generate a unique 8-character uppercase alphanumeric Booking ID.
     * Loops until it finds one that isn't already in the bookings table.
     */
    private function generateBookingId(): string
    {
        do {
            $id = strtoupper(substr(bin2hex(random_bytes(6)), 0, 8));
        } while (BookingNavarro::where('booking_id', $id)->exists());

        return $id;
    }

    private function validationMessages(): array
    {
        return [
            'event_room_navarro_id.required' => 'Please select a venue.',
            'event_room_navarro_id.exists'   => 'The selected venue is invalid.',
            'event_navarro_id.required'      => 'Please select an event type.',
            'event_navarro_id.exists'        => 'The selected event type is invalid.',
            'booking_date.required'          => 'Please select a booking date.',
            'booking_date.date'              => 'Please enter a valid date.',
            'booking_date.after_or_equal'    => 'Booking date cannot be in the past.',
            'num_persons.required'           => 'Number of persons is required.',
            'num_persons.integer'            => 'Number of persons must be a whole number.',
            'num_persons.min'                => 'There must be at least 1 person.',
            'num_persons.max'                => 'Maximum of 100 persons allowed per booking.',
        ];
    }

    /**
     * Returns all booked dates for a given venue as JSON.
     * Called by the calendar via fetch() when the user picks a venue.
     */
    public function getBookedDates(EventRoomNavarro $eventRoomNavarro): \Illuminate\Http\JsonResponse
    {
        $dates = $eventRoomNavarro->bookings()
            ->pluck('booking_date')
            ->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y-m-d'))
            ->values();

        return response()->json($dates);
    }
    /**
     * GET /booking/calendar-events
     * Returns bookings as JSON for the dashboard calendar.
     * Customers see only their own. Admins see all.
     */
    public function calendarEvents(Request $request): \Illuminate\Http\JsonResponse
    {
        $query = BookingNavarro::with(['eventRoom', 'eventType']);

        if (auth()->user()->isAdmin()) {
            $query->latest();
        } else {
            $query->where('user_id', auth()->id());
        }

        $events = $query->get()->map(function ($b) {
            $colors = [
                'pending'  => ['bg' => '#e0e7ff', 'text' => '#3730a3', 'border' => '#a5b4fc'],
                'accepted' => ['bg' => '#dcfce7', 'text' => '#166534', 'border' => '#86efac'],
                'rejected' => ['bg' => '#fee2e2', 'text' => '#991b1b', 'border' => '#fca5a5'],
            ];
            $color = $colors[$b->status] ?? $colors['pending'];

            return [
                'id'           => $b->id,
                'booking_id'   => $b->booking_id,
                'title'        => $b->eventType->name ?? 'Booking',
                'venue'        => $b->eventRoom->name ?? '—',
                'customer'     => $b->customer_name,
                'date'         => $b->booking_date->format('Y-m-d'),
                'num_persons'  => $b->num_persons,
                'status'       => $b->status,
                'bg'           => $color['bg'],
                'text'         => $color['text'],
                'border'       => $color['border'],
            ];
        });

        return response()->json($events);
    }
}
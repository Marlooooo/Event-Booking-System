<?php

namespace App\Http\Controllers;

use App\Models\BookingNavarro;
use App\Models\EventRoomNavarro;
use App\Models\EventNavarro;
use Illuminate\Http\Request;

class AdminNavarroController extends Controller
{
public function dashboard()
    {
        $stats = [
            'total'      => BookingNavarro::count(),
            'pending'    => BookingNavarro::where('status', 'pending')->count(),
            'accepted'   => BookingNavarro::where('status', 'accepted')->count(),
            'rejected'   => BookingNavarro::where('status', 'rejected')->count(),
            'venues'     => \App\Models\EventRoomNavarro::count(),
            'eventTypes' => \App\Models\EventNavarro::count(),
            'users'      => \App\Models\User::where('role', 'customer')->count(),
        ];

        $recentBookings = BookingNavarro::with(['eventRoom', 'eventType', 'user'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard-navarro', compact('stats', 'recentBookings'));
    }

    public function bookings(Request $request)
    {
        $status = $request->query('status', 'all');

        $query = BookingNavarro::with(['eventRoom', 'eventType', 'user'])->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $bookings = $query->get();

        return view('admin.bookings-navarro', compact('bookings', 'status'));
    }

    public function accept(BookingNavarro $bookingNavarro)
    {
        $bookingNavarro->update(['status' => 'accepted']);

        return redirect()->back()
            ->with('success', "Booking #{$bookingNavarro->booking_id} has been accepted.");
    }

    public function reject(BookingNavarro $bookingNavarro)
    {
        $bookingNavarro->update(['status' => 'rejected']);

        return redirect()->back()
            ->with('success', "Booking #{$bookingNavarro->booking_id} has been rejected.");
    }

    public function showBooking(BookingNavarro $bookingNavarro)
    {
        $bookingNavarro->load(['eventRoom', 'eventType', 'user']);

        return view('admin.booking-show-navarro', compact('bookingNavarro'));
    }
}
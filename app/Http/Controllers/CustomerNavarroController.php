<?php

namespace App\Http\Controllers;

use App\Models\BookingNavarro;
use Illuminate\Http\Request;

class CustomerNavarroController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        $bookings = BookingNavarro::with(['eventRoom', 'eventType'])
            ->where('user_id', $user->id)
            ->orderBy('booking_date', 'desc')
            ->get();

        $stats = [
            'total' => $bookings->count(),
            'pending' => $bookings->where('status', 'pending')->count(),
            'accepted' => $bookings->where('status', 'accepted')->count(),
            'rejected' => $bookings->where('status', 'rejected')->count(),
        ];

        return view('customer.dashboard-navarro', compact('bookings', 'stats'));
    }
}
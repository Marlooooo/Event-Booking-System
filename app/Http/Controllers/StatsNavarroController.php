<?php

namespace App\Http\Controllers;

use App\Models\BookingNavarro;
use App\Models\User;

class StatsNavarroController extends Controller
{
    public function live(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'total_bookings' => BookingNavarro::count(),
            'total_users'    => User::where('role', 'customer')->count(),
            'pending'        => BookingNavarro::where('status', 'pending')->count(),
            'accepted'       => BookingNavarro::where('status', 'accepted')->count(),
            'rejected'       => BookingNavarro::where('status', 'rejected')->count(),
        ]);
    }
}
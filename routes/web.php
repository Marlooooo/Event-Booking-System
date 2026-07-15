<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthNavarroController;
use App\Http\Controllers\AdminNavarroController;
use App\Http\Controllers\CustomerNavarroController;
use App\Http\Controllers\BookingNavarroController;
use App\Http\Controllers\EventRoomNavarroController;

/* ---------- Auth routes ---------- */
Route::get('/login', [AuthNavarroController::class, 'showLogin'])->name('login.navarro');
Route::get('/stats/live', [StatsNavarroController::class, 'live'])->name('stats.live.navarro')->middleware('auth');
Route::post('/login', [AuthNavarroController::class, 'login'])->name('login.navarro.store');
Route::get('/register', [AuthNavarroController::class, 'showRegister'])->name('register.navarro');
Route::post('/register', [AuthNavarroController::class, 'register'])->name('register.navarro.store');
Route::post('/logout', [AuthNavarroController::class, 'logout'])->name('logout.navarro');

/* ---------- Admin routes ---------- */
Route::prefix('admin')->middleware('admin.navarro')->group(function () {
    Route::get('/dashboard', [AdminNavarroController::class, 'dashboard'])->name('admin.dashboard.navarro');
    Route::get('/bookings', [AdminNavarroController::class, 'bookings'])->name('admin.bookings.navarro');
    Route::get('/bookings/{bookingNavarro}', [AdminNavarroController::class, 'showBooking'])->name('admin.booking.show.navarro');
    Route::patch('/bookings/{bookingNavarro}/accept', [AdminNavarroController::class, 'accept'])->name('admin.booking.accept.navarro');
    Route::patch('/bookings/{bookingNavarro}/reject', [AdminNavarroController::class, 'reject'])->name('admin.booking.reject.navarro');

    Route::resource('events-rooms', EventRoomNavarroController::class)
        ->parameters(['events-rooms' => 'eventRoomNavarro']);
});

/* ---------- Customer dashboard ---------- */
Route::get('/dashboard', [CustomerNavarroController::class, 'dashboard'])   
    ->middleware('customer.navarro')
    ->name('customer.dashboard.navarro');

    Route::middleware('auth')->group(function () {
    Route::get('/booking/calendar-events', [BookingNavarroController::class, 'calendarEvents'])
        ->name('booking.calendar-events');
});

/* ---------- Public multi-step booking wizard (customer only) ---------- */
Route::prefix('booking')->middleware('customer.navarro')->group(function () {

    Route::get('/start', [BookingNavarroController::class, 'start'])->name('booking.start');
    Route::post('/start', [BookingNavarroController::class, 'storeStart'])->name('booking.start.store');

    Route::get('/details', [BookingNavarroController::class, 'showDetailsForm'])->middleware('booking.step:details')->name('booking.details');
    Route::post('/details', [BookingNavarroController::class, 'storeDetails'])->middleware('booking.step:details')->name('booking.details.store');

    Route::get('/confirmation', [BookingNavarroController::class, 'showConfirmationForm'])->middleware('booking.step:confirmation')->name('booking.confirmation');
    Route::post('/confirmation', [BookingNavarroController::class, 'storeConfirmation'])->middleware('booking.step:confirmation')->name('booking.confirmation.store');

    Route::get('/summary', [BookingNavarroController::class, 'summary'])->middleware('booking.step:summary')->name('booking.summary');
    Route::get('/file/{filename}', [BookingNavarroController::class, 'downloadFile'])->middleware('booking.step:summary')->name('booking.file');

    Route::post('/reset', [BookingNavarroController::class, 'reset'])->name('booking.reset');

    Route::get('/my-bookings', [BookingNavarroController::class, 'myBookings'])->name('booking.my-bookings');
    Route::get('/my-bookings/{bookingNavarro}/edit', [BookingNavarroController::class, 'editMyBooking'])->name('booking.my-bookings.edit');
    Route::put('/my-bookings/{bookingNavarro}', [BookingNavarroController::class, 'updateMyBooking'])->name('booking.my-bookings.update');
    Route::delete('/my-bookings/{bookingNavarro}', [BookingNavarroController::class, 'cancelMyBooking'])->name('booking.my-bookings.cancel');
    Route::get('/booked-dates/{eventRoomNavarro}', [BookingNavarroController::class, 'getBookedDates'])->name('booking.booked-dates');
});

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->isAdmin()
            ? redirect()->route('admin.dashboard.navarro')
            : redirect()->route('customer.dashboard.navarro');
    }
    return redirect()->route('login.navarro');
});
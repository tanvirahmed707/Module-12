<?php
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TripController;





 Route::get('/trips/{tripId}/seats', [TicketController::class, 'showAvailableSeats'])
    ->name('tickets.showAvailableSeats');

Route::post('/trips/{tripId}/purchase', [TicketController::class, 'purchaseTicket'])
    ->name('tickets.purchaseTicket');

    
Route::get('/trips/create', [TripController::class, 'create'])
    ->name('trips.create');


Route::post('/trips', [TripController::class, 'store'])
    ->name('trips.store');
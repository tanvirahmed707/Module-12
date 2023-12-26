

@extends('layouts.app') 

@section('content')
    <h1>Available Seats for Trip {{ $trip->id }}</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <p>Trip Details: {{ $trip->from_location->name }} to {{ $trip->to_location->name }} on {{ $trip->trip_date }}</p>

    @if(count($availableSeats) > 0)
        <p>Available Seats: {{ implode(', ', $availableSeats) }}</p>
        {{-- Add a form to allow users to select a seat and purchase a ticket --}}
        <form method="POST" action="{{ route('tickets.purchaseTicket', ['tripId' => $trip->id]) }}">
            @csrf
            <label for="seat_number">Select Seat Number:</label>
            <input type="number" name="seat_number" min="1" max="36" required>
            <button type="submit">Purchase Ticket</button>
        </form>
    @else
    <a href="{{ route('tickets.showAvailableSeats', ['tripId' => $trip->id]) }}">View Available Seats</a>

        <p>No available seats for this trip.</p>
    @endif
@endsection

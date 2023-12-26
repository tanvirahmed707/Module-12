<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\Trip;
use App\Models\SeatAllocation;
use App\Models\Location;

class TicketController extends Controller
{
    public function showAvailableSeats($tripId)
    {
        try {
            $trip = Trip::findOrFail($tripId);
            $availableSeats = $this->getAvailableSeats($trip);

            return view('tickets.available_seats', compact('trip', 'availableSeats'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Trip not found.');
        }
    }

    public function purchaseTicket(Request $request, $tripId)
    {
        
        $request->validate([
            'seat_number' => 'required|integer|min:1|max:36',
        ]);

        try {
            $trip = Trip::findOrFail($tripId);
            $availableSeats = $this->getAvailableSeats($trip);

            
            if (!in_array($request->input('seat_number'), $availableSeats)) {
                return back()->with('error', 'The selected seat is not available.');
            }

            
             
                SeatAllocation::create([
                    'trip_id' => $tripId,
                    'user_id' => auth()->id(),
                    'seat_number' => $request->input('seat_number'),
                ]);
            

           
            return redirect('/trips')->with('success', 'Ticket purchased successfully!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return back()->with('error', 'Trip not found.');
        } catch (\Exception $e) {
           
         
            return back()->with('error', 'An error occurred while processing your request.');
        }
    }

    private function getAvailableSeats(Trip $trip)
    {
        $reservedSeats = $trip->seatAllocations->pluck('seat_number')->toArray();
        $allSeats = range(1, 36);
        $availableSeats = array_diff($allSeats, $reservedSeats);

        return $availableSeats;
    }
}



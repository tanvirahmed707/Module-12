<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Trip;
use App\Http\Controllers\Controller;




class TripController extends Controller
{
   


    public function create()
    {
        
        $locations = Location::whereIn('name', ['Dhaka', 'Comilla', 'Chittagong', "Cox's Bazaar"])
            ->get();

        return view('trips.create', compact('locations'));
    }




    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'from_location' => 'required|exists:locations,id',
            'to_location' => 'required|exists:locations,id',
            'trip_date' => 'required|date',
        ]);

        
        $trip = Trip::create([
            'from_location_id' => $request->input('from_location'),
            'to_location_id' => $request->input('to_location'),
            'trip_date' => $request->input('trip_date'),
        ]);

       
        return redirect('/trips')->with('success', 'Trip created successfully!');
    }
}




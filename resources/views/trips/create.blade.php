

 @extends('layouts.app')

@section('content')
    <h1>Create a New Trip</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('trips.store') }}">
        @csrf
        <div class="form-group">
            <label for="from_location">From Location:</label>
            <select name="from_location" class="form-control" required>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="to_location">To Location:</label>
            <select name="to_location" class="form-control" required>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="trip_date">Trip Date:</label>
            <input type="date" name="trip_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Trip</button>
    </form>
@endsection

@extends('layouts.app')

@section('title', 'Regular History')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3><i class="fa-solid fa-spoon"></i> Regular Order</h3>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3"><h3>- Histry -</h3></div>
                        <div class="col-md-6 mb-3"><a href="{{route('rsv.regular.index')}}" class="btn btn-outline-secondary w-100">Back to today's reservation</a></div>
                    </div>
                    @if(count($reservations) > 0)
                        <div class="my-3">
                            <div class="table-responsive">
                                <table class="table table-hover text-center align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Date</th>
                                            <th>Delivery Time</th>
                                            <th>Guest Name</th>
                                            <th>Room No.</th>
                                            <th>Number of guest</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach($reservations as $reservation)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($reservation->other_date)->format('F jS, Y') }}</td>
                                                @if($reservation->other_time == null)
                                                    <td>--:--</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($reservation->other_time)->format('H:i') }}</td>
                                                @endif
                                                <td>{{$reservation->guest_name}}</td>
                                                <td>{{$reservation->room_number}}</td>
                                                @if(count($reservation->kids) > 0)
                                                    <td>{{$reservation->people_number}} (child: {{count($reservation->kids)}})</td>
                                                @else
                                                    <td>{{$reservation->people_number}}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="text-center my-5"><h1>No reservation</h1></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
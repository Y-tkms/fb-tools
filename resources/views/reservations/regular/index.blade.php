@extends('layouts.app')

@section('title', 'Regular')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row mb-5">
                <div class="col-md-6"><h3><i class="fa-solid fa-spoon"></i> Regular Order</h3></div>
                @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                    <div class="col-md-6">
                        <a href="{{route('rsv.regular.create')}}" class="btn btn-primary w-100 fw-bold">Create Reservation</a>
                    </div>
                @endif
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6 mb-3"><h3>- Today: {{ \Carbon\Carbon::parse($today)->format('F jS, Y') }} -</h3></div>
                        <div class="col-md-3 mb-3"><a href="{{route('rsv.regular.history')}}" class="btn btn-outline-secondary w-100">History</a></div>
                        <div class="col-md-3 mb-3"><a href="{{route('rsv.regular.other')}}" class="btn btn-outline-success w-100">Other Date</a></div>
                    </div>
                    @if(count($reservations) > 0)
                        <div class="my-3">
                            <div class="table-responsive">
                                <table class="table table-hover text-center align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Delivery Time</th>
                                            <th>Guest Name</th>
                                            <th>Room No.</th>
                                            <th>Number of guest</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach($reservations as $reservation)
                                            <tr>
                                                @if($reservation->other_time == null)
                                                    <td>--:--</td>
                                                @else
                                                    <td>{{ \Carbon\Carbon::parse($reservation->other_time)->format('H:i') }}</td>
                                                @endif
                                                @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                                                    <td><a href="{{route('rsv.regular.edit', ['id' => $reservation->id, 'type' => 'today'])}}">{{$reservation->guest_name}}</a></td>
                                                @else
                                                    <td>{{$reservation->guest_name}}</td>
                                                @endif
                                                <td>{{$reservation->room_number}}</td>
                                                @if(count($reservation->kids) > 0)
                                                    <td>{{$reservation->people_number}} (child: {{count($reservation->kids)}})</td>
                                                @else
                                                    <td>{{$reservation->people_number}}</td>
                                                @endif
                                                <td>
                                                    <form action="{{route('rsv.regular.complete', $reservation->id)}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-outline-danger"><i class="fa-regular fa-circle-xmark"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="text-center my-5"><h1>No reservation today</h1></div>
                    @endif
                    @if(count($complete) > 0)
                        <h3 class="mb-4">- Completed Order -</h3>
                        <div class="mt-3">
                            <div class="table-responsive">
                                <table class="table table-hover text-center align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Delivery Time</th>
                                            <th>Guest Name</th>
                                            <th>Room No.</th>
                                            <th>Number of guest</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        @foreach($complete as $reservation)
                                            <tr>
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
                                                <td>
                                                    <form action="{{route('rsv.regular.return', $reservation->id)}}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-outline-success"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
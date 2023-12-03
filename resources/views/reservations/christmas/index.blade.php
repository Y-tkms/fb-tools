@extends('layouts.app')

@section('title', 'Christmas')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row mb-5">
                <div class="col-md-6"><h3><i class="fa-solid fa-holly-berry"></i> Christmas Order</h3></div>
                @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                    <div class="col-md-6">
                        <a href="{{route('rsv.xmas.create')}}" class="btn btn-primary w-100 fw-bold">Create Reservation</a>
                    </div>
                @endif
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6 mb-3"><h3>- Reservation List -</h3></div>
                        <div class="col-md-6 mb-3"><a href="{{route('rsv.xmas.history')}}" class="btn btn-outline-secondary w-100">All Reservation</a></div>
                    </div>
                    @if(count($date) > 0)
                        <div class="my-3">
                            @foreach($date as $day)
                                <h3>{{ \Carbon\Carbon::parse($day->date)->format('F jS, Y') }}</h3>
                                @if(count($day->reservations) > 0)
                                    <ul class="list-group mb-4">
                                        @foreach($reservations as $reservation)
                                            @if($reservation->date_id == $day->id)
                                                <li class="list-group-item border-dark">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p class="mb-0">Time: {{ \Carbon\Carbon::parse($reservation->other_time)->format('H:i') }}</p>
                                                            @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                                                                <p class="mb-0">Name: <a href="{{route('rsv.xmas.edit', $reservation->id)}}" class="text-decoration-none">{{$reservation->guest_name}}</a></p>
                                                            @else
                                                                <p class="mb-0">Name: {{$reservation->guest_name}}</p>
                                                            @endif
                                                            <p class="mb-0">Room No.: {{$reservation->room_number}}</p>
                                                            @if(count($reservation->kids) > 0)
                                                                <p class="mb-0">PPL: {{$reservation->people_number}} <a href="{{route('rsv.xmas.show', $reservation->id)}}" class="text-decoration-none">(child: {{count($reservation->kids)}})</a></p>
                                                            @else
                                                                <p class="mb-0">PPL: {{$reservation->people_number}}</p>
                                                            @endif
                                                            <p class="mb-0">Dish: {{$reservation->order->dish}}</p>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p class="mb-0">Note:</p>
                                                            <p class="mb-0 text-break">{{$reservation->preference}}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-danger">No reservation yet.</p>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center my-5"><h1>Please set date.</h1></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
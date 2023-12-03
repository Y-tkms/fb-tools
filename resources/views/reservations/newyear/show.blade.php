@extends('layouts.app')

@section('title', 'New Year List')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row mb-5">
                <div class="col-md-4">
                    @if($type == 'dec')
                        <h3 class="mb-0"><i class="fa-solid fa-mountain-sun"></i> Reservation of 12/31</h3>
                    @else
                        <h3 class="mb-0"><i class="fa-solid fa-mountain-sun"></i> Reservation of 1/1</h3>
                    @endif
                </div>
                <div class="col-md-4 text-center">
                    @if($type == 'dec')
                        <h1>{{$dec_max - $dec_total}} / {{$dec_max}} remaining</h1>
                    @else
                        <h1>{{$jan_max - $jan_total}} / {{$jan_max}} remaining</h1>
                    @endif
                </div>
                <div class="col-md-4">
                    @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')                      
                        <a href="{{route('rsv.newyear.create', ['type' => $type])}}" class="btn btn-primary w-100 fw-bold">Create Reservation</a>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6 mb-3"><h3>- Reservation List -</h3></div>
                        <div class="col-md-2 mb-3"><a href="{{route('rsv.newyear.history', ['type' => $type])}}" class="btn btn-outline-secondary fw-bold w-100">History</a></div>
                        @if($type == 'dec')
                            <div class="col-md-2 mb-3"><a href="{{route('rsv.newyear.show', ['type' => 'jan'])}}" class="btn btn-outline-success fw-bold w-100">Go to 1/1</a></div>
                        @else
                            <div class="col-md-2 mb-3"><a href="{{route('rsv.newyear.show', ['type' => 'dec'])}}" class="btn btn-outline-success fw-bold w-100">Go to 12/31</a></div>
                        @endif
                        <div class="col-md-2 mb-3"><a href="{{route('rsv.newyear.alldelete', ['type' => $type])}}" class="btn btn-outline-danger fw-bold w-100">Reset All</a></div>
                    </div>
                    @if(count($time) > 0)
                        <div class="my-3">
                            @foreach($time as $at)
                                <h3>{{ \Carbon\Carbon::parse($at->time)->format('H:i') }}</h3>
                                @if(count($at->reservations) > 0)
                                    <ul class="list-group mb-4">
                                        @foreach($reservations as $reservation)
                                            @if($reservation->time_id == $at->id)
                                                <li class="list-group-item border-dark">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                                                                <p class="mb-0">Name: <a href="{{route('rsv.newyear.edit', ['id' => $reservation->id, 'type' => $type])}}" class="text-decoration-none">{{$reservation->guest_name}}</a></p>
                                                            @else
                                                                <p class="mb-0">Name: {{$reservation->guest_name}}</p>
                                                            @endif
                                                            <p class="mb-0">Room No.: {{$reservation->room_number}}</p>
                                                            @if(count($reservation->kids) > 0)
                                                                <p class="mb-0">PPL: {{$reservation->people_number}} <a href="{{route('rsv.newyear.kid.show', ['id' => $reservation->id, 'type' => $type])}}" class="text-decoration-none">(child: {{count($reservation->kids)}})</a></p>
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
                        <div class="text-center my-5"><h1>Please set time.</h1></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
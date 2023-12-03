@extends('layouts.app')

@section('title', 'Arrangement')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row mb-5">
                <div class="col-md-6"><h3><i class="fa-solid fa-cake-candles"></i> Arrangement</h3></div>
                @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                    <div class="col-md-6">
                        <a href="{{route('rsv.arrangement.create')}}" class="btn btn-primary w-100 fw-bold">Create Reservation</a>
                    </div>
                @endif
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6 mb-3 text-center">
                            <h3>- Today's Reservation -</h3>
                            <h3>{{ \Carbon\Carbon::parse($today)->format('F jS, Y') }}</h3>
                        </div>
                        <div class="col-md-6 mb-3"><a href="{{route('rsv.arrangement.history')}}" class="btn btn-outline-secondary w-100">History</a></div>
                    </div>
                        <div class="my-3">
                                @if(count($reservations) > 0)
                                    <ul class="list-group mb-4">
                                        @foreach($reservations as $reservation)
                                                <li class="list-group-item border-dark">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p class="mb-0">Time: {{$reservation->other_time}}</p>
                                                            @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                                                                <p class="mb-0">Name: <a href="{{route('rsv.arrangement.edit', $reservation->id)}}" class="text-decoration-none">{{$reservation->guest_name}}</a></p>
                                                            @else
                                                                <p class="mb-0">Name: {{$reservation->guest_name}}</p>
                                                            @endif
                                                            <p class="mb-0">Room No.: {{$reservation->room_number}}</p>
                                                            <p class="mb-0">PPL: {{$reservation->people_number}}</p>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p class="mb-0">Note:</p>
                                                            <p class="mb-0 text-break">{{$reservation->preference}}</p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @foreach($reservation->arrangements as $arrangement)
                                                    @if($arrangement->arr_item_id)
                                                        <span class="fw-bold">Name: {{$arrangement->arr_item->name}}</span>
                                                    @elseif($arrangement->other_item)
                                                        <span class="fw-bold">Name: {{$arrangement->other_item}}</span>
                                                    @else
                                                        <span class="fw-bold">Name: </span>
                                                    @endif
                                                    <p>{{$arrangement->information}}</p>
                                                    @endforeach
                                                </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-danger">No reservation yet.</p>
                                @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
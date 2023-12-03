@extends('layouts.app')

@section('title', 'New Year History')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if($type == 'dec')
                <h3><i class="fa-solid fa-holly-berry"></i> New Year Order of 12/31</h3>
            @else
                <h3><i class="fa-solid fa-holly-berry"></i> New Year Order of 1/1</h3>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6"><h3>- History -</h3></div>
                        <div class="col-md-6"><a href="{{route('rsv.newyear.show', ['type' => $type])}}" class="btn btn-outline-secondary w-100">Back to index</a></div>
                    </div>
                    <div class="my-3">
                        @if(count($reservations) > 0)
                            <ul class="list-group mb-4">
                                @foreach($reservations as $reservation)
                                    <li class="list-group-item border-dark">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-0">Time: {{ \Carbon\Carbon::parse($reservation->time->time)->format('H:i') }}</p>
                                                <p class="mb-0">Name: {{$reservation->guest_name}}</p>
                                                <p class="mb-0">Room No.: {{$reservation->room_number}}</p>
                                                @if(count($reservation->kids) > 0)
                                                    <p class="mb-0">PPL: {{$reservation->people_number}} (child: {{count($reservation->kids)}})</p>
                                                @else
                                                    <p class="mb-0">PPL: {{$reservation->people_number}}</p>
                                                @endif
                                                <p class="mb-0">Dish: {{$reservation->order->dish}}</p>
                                                <p class="mb-0">created at: {{$reservation->created_at}}</p>
                                            </div>
                                            <div class="col-md-8">
                                                <p class="mb-0">Note:</p>
                                                <p class="mb-0 text-break">{{$reservation->preference}}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-danger">No Reservation</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
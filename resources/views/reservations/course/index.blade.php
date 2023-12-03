@extends('layouts.app')

@section('title', 'Course')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row mb-5">
                <div class="col-md-6"><h3><i class="fa-solid fa-champagne-glasses"></i> Course Reservation</h3></div>
                @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                    <div class="col-md-6">
                        <a href="{{route('rsv.course.create')}}" class="btn btn-primary w-100 fw-bold">Create Reservation</a>
                    </div>
                @endif
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6 mb-3"><h3>- Reservation List -</h3></div>
                        <div class="col-md-6 mb-3"><a href="{{route('rsv.course.history')}}" class="btn btn-outline-secondary w-100">History</a></div>
                    </div>
                    <div class="my-3">
                        @if(count($reservations) > 0)
                            @for($i = 0; $i < 7; $i++)
                                <h3>{{ \Carbon\Carbon::parse($today)->addDays($i)->format('F jS, Y') }}</h3>
                                <ul class="list-group mb-4">
                                    @foreach($reservations as $reservation)
                                        @if(\Carbon\Carbon::parse($reservation->other_date)->isSameDay($today->copy()->addDays($i)))
                                            <li class="list-group-item border-dark">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        @if($reservation->other_time == null)
                                                            <p class="mb-0">Time: --:--</p>
                                                        @else
                                                            <p class="mb-0">Time: {{ \Carbon\Carbon::parse($reservation->other_time)->format('H:i') }}</p>
                                                        @endif
                                                        @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                                                            <p class="mb-0">Name: <a href="{{route('rsv.course.edit', $reservation->id)}}" class="text-decoration-none">{{$reservation->guest_name}}</a></p>
                                                        @else
                                                            <p class="mb-0">Name: {{$reservation->guest_name}}</p>
                                                        @endif
                                                        <p class="mb-0">Room No.: {{$reservation->room_number}}</p>
                                                        <p class="mb-0">PPL: {{$reservation->people_number}}</p>
                                                        @if($reservation->order)
                                                            <p class="mb-0">Dish: {{ $reservation->order->dish }}</p>
                                                            @if($reservation->order->order_item_id)
                                                                @if($reservation->order->order_item->name == 'Japanese Course')
                                                                    <p class="mb-0">Menu: Japanese Course</p>
                                                                @else
                                                                    <p class="mb-0">Menu: Western Course</p>
                                                                @endif
                                                            @else
                                                                <p class="mb-0">Menu: TBA</p>
                                                            @endif
                                                        @else
                                                            <p class="mb-0">no order</p>
                                                        @endif
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
                            @endfor
                        @else
                            <h1 class="text-center">No Reservation yet.</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
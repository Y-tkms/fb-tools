@extends('layouts.app')

@section('title', 'Regular History')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3><i class="fa-solid fa-champagne-glasses"></i> Course Reservation</h3>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3"><h3>- Histry -</h3></div>
                        <div class="col-md-6 mb-3"><a href="{{route('rsv.course.index')}}" class="btn btn-outline-secondary w-100">Back to today's reservation</a></div>
                    </div>
                    @if(count($reservations) > 0)
                        <div class="my-3">
                            <ul class="list-group mb-4">
                                @foreach($reservations as $reservation)
                                    <li class="list-group-item border-dark">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-0">Date: {{ \Carbon\Carbon::parse($reservation->other_date)->format('F jS, Y') }}</p>
                                                @if($reservation->other_time == null)
                                                    <p class="mb-0">Time: --:--</p>
                                                @else
                                                    <p class="mb-0">Time: {{ \Carbon\Carbon::parse($reservation->other_time)->format('H:i') }}</p>
                                                @endif
                                                <p class="mb-0">Name: {{$reservation->guest_name}}</p>
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
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="text-center my-5"><h1>No reservation</h1></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Arrangement History')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row mb-5">
                <div class="col-md-6"><h3><i class="fa-solid fa-cake-candles"></i> Arrangement</h3></div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6 mb-3 text-center">
                            <h3>- History -</h3>
                        </div>
                        <div class="col-md-6 mb-3"><a href="{{route('rsv.arrangement.index')}}" class="btn btn-outline-secondary w-100">Back to index</a></div>
                    </div>
                        <div class="my-3">
                                @if(count($reservations) > 0)
                                    <ul class="list-group mb-4">
                                        @foreach($reservations as $reservation)
                                                <li class="list-group-item border-dark">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p class="mb-0">Time: {{$reservation->other_time}}</p>
                                                            <p class="mb-0">Name: {{$reservation->guest_name}}</p>
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
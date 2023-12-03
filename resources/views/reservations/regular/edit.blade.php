@extends('layouts.app')

@section('title', 'Regular Edit')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"><h3 class="mb-0">Edit Reservation</h3></div>
                        <div class="col-md-6 text-end"><h3 class="mb-0">- for Regular -</h3></div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('rsv.regular.update', ['id' => $reservation->id, 'type' => $type])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Guest Name <i class="text-danger">*required</i></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name', $reservation->guest_name)}}" autofocus placeholder="Guest Name">
                                @error('name')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_num" class="form-label">Room No.</label>
                                <input type="number" name="room_num" id="room_num" class="form-control" value="{{old('room_num', $reservation->room_number)}}" placeholder="Room No.">
                                @error('room_num')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label">Date <i class="text-danger">*required</i></label>
                                <input type="date" name="date" id="date" class="form-control" value="{{old('date', $reservation->other_date)}}">
                                @error('date')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="time" class="form-label">Delivery Time</label>
                                <input type="time" name="time" id="time" class="form-control" value="{{old('time', $reservation->other_time)}}">
                                @error('time')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="total" class="form-label">Total number of guest (include child)</label>
                            <div class="col-md-6 mb-3">
                                <input type="number" name="total" id="total" class="form-control" value="{{old('total', $reservation->people_number)}}" placeholder="Total">
                                @error('total')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                                    <a href="{{route('rsv.regular.delete', ['id' => $reservation->id, 'type' => $type])}}" class="btn btn-outline-danger w-100 fw-bold">DELETE</a>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                @if($type == 'today')
                                    <a href="{{route('rsv.regular.index')}}" class="btn btn-secondary fw-bold w-100">Cancel</a>
                                @else
                                    <a href="{{route('rsv.regular.other')}}" class="btn btn-secondary fw-bold w-100">Cancel</a>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-warning w-100 fw-bold">Save Change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
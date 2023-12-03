@extends('layouts.app')

@section('title', 'Arrangement Edit')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"><h3 class="mb-0">Edit Reservation</h3></div>
                        <div class="col-md-6 text-end"><h3 class="mb-0">- for Arrangement -</h3></div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('rsv.arrangement.update', $reservation->id)}}" method="POST">
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
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{old('phone', $reservation->phone_number)}}" placeholder="Phone Number">
                                @error('phone')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">E-mail Address</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{old('email', $reservation->email)}}" placeholder="E-mail Address">
                                @error('email')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label">Date <i class="text-danger">*required</i></label>
                                <input type="date" class="form-control" name="date" id="date" value="{{old('date', $reservation->other_date)}}">
                                @error('date')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="time" class="form-label">Delivery Time <i class="text-danger">*required</i></label>
                                <input type="text" name="time" id="time" class="form-control" value="{{old('time', $reservation->other_time)}}" placeholder="Delivery Time">
                                @error('time')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <label for="total" class="form-label">Total number of guest</label>
                            <div class="col-md-6 mb-3">
                                <input type="text" name="total" id="total" class="form-control" value="{{old('total', $reservation->people_number)}}" placeholder="Total">
                                @error('total')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{route('rsv.arrangement.show', $reservation->id)}}" class="btn btn-outline-warning w-100 text-dark">
                                    <i class="fa-solid fa-gifts"></i> Edit Arrangements
                                </a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="preference" class="form-label">Preference</label>
                            <textarea name="preference" id="preference" rows="3" class="form-control" placeholder="Enter Information about allergy, dietary restrictions, etc...">{{old('preference', $reservation->preference)}}</textarea>
                            @error('preference')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="text-end">
                            <div class="row">
                                <div class="col-md-4 mb-3"><a href="{{route('rsv.arrangement.index')}}" class="btn btn-secondary fw-bold w-100">Index</a></div>
                                <div class="col-md-4 mb-3"><button type="submit" class="btn btn-warning fw-bold w-100">Save Change</button></div>
                                <div class="col-md-4 mb-3"><a href="{{route('rsv.arrangement.delete', $reservation->id)}}" class="btn btn-danger fw-bold w-100">Delete</a></div>
                            </div>         
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
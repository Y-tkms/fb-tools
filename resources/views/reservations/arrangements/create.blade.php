@extends('layouts.app')

@section('title', 'Arrangement Create')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"><h3 class="mb-0">Create Reservation</h3></div>
                        <div class="col-md-6 text-end"><h3 class="mb-0">- for Arrangement -</h3></div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('rsv.arrangement.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Guest Name <i class="text-danger">*required</i></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" autofocus placeholder="Guest Name">
                                @error('name')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_num" class="form-label">Room No.</label>
                                <input type="number" name="room_num" id="room_num" class="form-control" value="{{old('room_num')}}" placeholder="Room No.">
                                @error('room_num')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{old('phone')}}" placeholder="Phone Number">
                                @error('phone')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">E-mail Address</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" placeholder="E-mail Address">
                                @error('email')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label">Date <i class="text-danger">*required</i></label>
                                <input type="date" class="form-control" name="date" id="date" value="{{old('date')}}">
                                @error('date')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="time" class="form-label">Delivery Time <i class="text-danger">*required</i></label>
                                <input type="text" name="time" id="time" class="form-control" value="{{old('time')}}" placeholder="Delivery Time">
                                @error('time')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="item" class="form-label">Number of item <i class="text-danger">*required</i></label>
                                <input type="number" name="item" id="item" class="form-control" value="{{old('item')}}" placeholder="item">
                                @error('item')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="total" class="form-label">Total number of guest</label>
                                <input type="text" name="total" id="total" class="form-control" value="{{old('total')}}" placeholder="Total">
                                @error('total')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="preference" class="form-label">Preference</label>
                            <textarea name="preference" id="preference" rows="3" class="form-control" placeholder="Enter Information about allergy, dietary restrictions, etc...">{{old('preference')}}</textarea>
                            @error('preference')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-5 fw-bold">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Christmas Edit')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"><h3 class="mb-0">Edit Reservation</h3></div>
                        <div class="col-md-6 text-end"><h3 class="mb-0">- for Christmas -</h3></div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('rsv.xmas.update', $reservation->id)}}" method="POST">
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
                                <select name="date" id="date" class="form-control">
                                    <option value="">-- Select Date --</option>
                                    @foreach($date as $day)
                                        @if($reservation->rsv_section_id == $day->id)
                                            <option value="{{$day->id}}" selected>{{ \Carbon\Carbon::parse($day->date)->format('F jS, Y') }}</option>
                                        @else
                                            <option value="{{$day->id}}">{{ \Carbon\Carbon::parse($day->date)->format('F jS, Y') }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('date')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="time" class="form-label">Delivery Time <i class="text-danger">*required</i></label>
                                <input type="time" name="time" id="time" class="form-control" value="{{old('time', $reservation->other_time)}}">
                                @error('time')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="dish" class="form-label">Number of dish <i class="text-danger">*required</i></label>
                                <input type="number" name="dish" id="dish" class="form-control" value="{{old('dish', $reservation->order->dish)}}" placeholder="Dish">
                                @error('dish')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="total" class="form-label">Total number of guest (include child)</label>
                                <input type="number" name="total" id="total" class="form-control" value="{{old('total', $reservation->people_number)}}" placeholder="Total">
                                @error('total')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                @if(count($reservation->kids) > 0)
                                    <a href="{{route('rsv.xmas.show', $reservation->id)}}" class="btn btn-outline-warning text-dark w-100"><i class="fa-solid fa-children fa-2x mt-3 mb-2"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="preference" class="form-label">Preference</label>
                            <textarea name="preference" id="preference" rows="3" class="form-control" placeholder="Enter Information about allergy, dietary restrictions, etc...">{{old('preference', $reservation->preference)}}</textarea>
                            @error('preference')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <a href="{{route('rsv.xmas.index')}}" class="btn btn-secondary w-100 fw-bold">Cancel</a>
                            </div>
                            <div class="col-md-4 mb-3">
                                <button type="submit" class="btn btn-warning w-100 fw-bold">Save Change</button>
                            </div>
                            <div class="col-md-4 mb-3">
                                <a href="{{route('rsv.xmas.delete', $reservation->id)}}" class="btn btn-danger w-100 fw-bold">Delete</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Course Edit')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"><h3 class="mb-0">Edit Reservation</h3></div>
                        <div class="col-md-6 text-end"><h3 class="mb-0">- for Course -</h3></div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('rsv.course.update', $reservation->id)}}" method="POST">
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
                            <div class="col-md-4 mb-3">
                                <label for="dish" class="form-label">Menu</label>
                                <select name="menu" id="menu" class="form-select">
                                    <option value="" selected>-- TBA --</option>
                                    @foreach($menus as $menu)
                                        @if($menu->id == $reservation->order->order_item_id)
                                            <option value="{{$menu->id}}" selected>{{$menu->name}}</option>
                                        @else
                                            <option value="{{$menu->id}}" selected>{{$menu->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('menu')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dish" class="form-label">Number of dish <i class="text-danger">*required</i></label>
                                <input type="number" name="dish" id="dish" class="form-control" value="{{old('dish', $reservation->order->dish)}}" placeholder="Dish">
                                @error('dish')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="total" class="form-label">Total number of guest <i class="text-danger">*required</i></label>
                                <input type="number" name="total" id="total" class="form-control" value="{{old('total', $reservation->people_number)}}" placeholder="Total">
                                @error('total')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
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
                            <button type="submit" class="btn btn-warning fw-bold">Save Change</button>
                            <a href="{{route('rsv.course.delete', $reservation->id)}}" class="btn btn-danger fw-bold ms-3">Delete</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
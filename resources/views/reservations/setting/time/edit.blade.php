@extends('layouts.app')

@section('title', 'Edit Time')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{route('rsv.set.time.update', $time->id)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Time</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label for="time" class="form-label">Delivery Time</label>
                            <div class="col-md-6 mb-3">
                                <input type="time" name="time" id="time" class="form-control" value="{{old('time', $time->time)}}" autofocus>
                                @error('time')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-warning w-100">Save Change</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Edit Date')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{route('rsv.set.date.update', $date->id)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6"><h3 class="m-0">Edit Date</h3></div>
                            <div class="col-md-6 text-end"><h3 class="m-0 fw-bold">- in {{$year}} -</h3></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label for="date" class="form-label">Date</label>
                            <div class="col-md-6 mb-2">
                                <input type="date" name="date" id="date" class="form-control" value="{{old('date', $date->date)}}">
                                @error('date')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <button type="submit" class="btn btn-warning w-100">Save Change</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-danger text-center">
                        <p class="fw-bold mb-0">When you change date, the related data will also be changed automatically</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
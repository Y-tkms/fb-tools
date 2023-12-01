@extends('layouts.app')

@section('title', 'RSV Section')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{route('rsv.set.sec.update', $section->id)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Section</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label for="name" class="form-label">Section Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{old('name', $section->name)}}">
                            @error('name')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <label for="max" class="form-label">Maximun</label>
                            <div class="col-md-6 mb-2">
                                <input type="number" name="max" id="max" class="form-control" value="{{old('max', $section->max)}}" placeholder="Enter Maximun Number">
                            </div>
                            <div class="col-md-6 mb-2">
                                <button type="submit" class="btn btn-warning w-100">Save Change</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
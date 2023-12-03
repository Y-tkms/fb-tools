@extends('layouts.app')

@section('title', 'New Year Kids')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h3 class="mb-0">Edit Children</h3></div>
                    @if($type == 'dec')
                        <div class="col-md-6 text-end"><h3 class="mb-0">- for New Year 12/31 -</h3></div>
                    @else
                        <div class="col-md-6 text-end"><h3 class="mb-0">- for New Year 1/1 -</h3></div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('rsv.newyear.kid.update', ['id' => $kid->id, 'type' => $type])}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="text" name="age" id="age" class="form-control" value="{{old('age', $kid->age)}}">
                    </div>
                    <div class="mb-3">
                        <label for="info" class="form-label">Information</label>
                        <textarea name="info" id="info" rows="1" class="form-control">{{old('info', $kid->info)}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 text-dark">Save Change</button>
                </form>
            </div>
            <div class="card-footer">
                <form action="{{route('rsv.newyear.kid.destroy', ['id' => $kid->id, 'type' => $type])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{route('rsv.set.arr.update', $item->id)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6"><h3 class="m-0">Edit Item</h3></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label for="name" class="form-label">Item Name</label>
                            <div class="col-md-6 mb-2">
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name', $item->name)}}" autofocus>
                                @error('name')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <button type="submit" class="btn btn-primary w-100">Save</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-danger text-center">
                        <p class="fw-bold mb-0">When you change this item, the related data will also be changed automatically</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
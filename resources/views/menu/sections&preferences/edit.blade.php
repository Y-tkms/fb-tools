@extends('layouts.app')

@section('title', 'Delete Section $ Preference')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="m-0">Create Section</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('menu.section.update', ['id' => $data->id, 'type' => $type])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-9">
                                <label for="name" class="form-label">Section Name</label>
                                <input type="text" class="form-control mb-2" name="name" id="name" placeholder="Section Name" value="{{old('name', $data->name)}}">
                                @error('name')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-3 mt-auto">
                                <button type="submit" class="btn btn-primary w-100 mb-2">
                                    <i class="fa-solid fa-check"></i> Save Change
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Create Menu')

@section('content')
    <div class="container w-75">
        <div class="card">
            <div class="card-header d-flex">
                <h3 class="m-0">Create Menu</h3>
                <a href="{{route('menu.index')}}" class="btn btn-secondary ms-auto">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
            </div>
            <div class="card-body">
                <form action="{{route('menu.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-8">
                            <label for="name" class="form-label">Name <span class="text-danger">* Required</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{old('name')}}">
                            @error('name')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="section" class="form-label">Section</label>
                            <select name="section" id="section" class="form-select">
                                <option value="">Select Section</option>
                                @if(!empty($all_sections) && count($all_sections) > 0)
                                    @foreach($all_sections as $section)
                                        <option value="{{$section->id}}">{{$section->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('section')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" class="form-control" placeholder="Price" value="{{old('price')}}">
                            @error('price')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @error('image')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="preference" class="form-label">Preference</label>
                            <select name="preference" id="preference" class="form-select">
                                <option value="">Select Preference</option>
                                @if(!empty($all_preference) && count($all_preference) > 0)
                                    @foreach($all_preference as $preference)
                                        <option value="{{$preference->id}}">{{$preference->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Description">{{old('description')}}</textarea>
                        @error('description')
                            <p class="text-danger small">{{$message}}</p>
                        @enderror
                    </div>
                    <div>
                        <a href="{{route('menu.index')}}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary ms-3">
                            <i class="fa-solid fa-check"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
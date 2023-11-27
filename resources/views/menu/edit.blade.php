@extends('layouts.app')

@section('title', 'Edit Menu')

@section('content')
    <form action="{{route('menu.update', $menu->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0">Image</h5>
                    </div>
                    <div class="card-body">
                        @if($menu->image)
                            <img src="{{asset('images/' . $menu->image)}}" alt="Menu Image" class="img-fluid w-100">
                        @else
                            <i class="fa-solid fa-image fa-10x d-block text-center"></i>
                        @endif
                    </div>
                    <div class="card-footer">
                        <input type="file" name="image" class="form-control">
                    </div>
                    @error('image')
                        <p class="text-danger small">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0">Edit Menu</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-8">
                                <label for="name" class="form-label">Name <span class="text-danger">* Required</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{old('name', $menu->name)}}">
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
                                            @if($section->id == $menu->section_id)
                                                <option value="{{$section->id}}" selected>{{$section->name}}</option>
                                            @else
                                                <option value="{{$section->id}}">{{$section->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                @error('section')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price" id="price" class="form-control" placeholder="Price" value="{{old('price', $menu->price)}}">
                                @error('price')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="preference" class="form-label">Preference</label>
                                <select name="preference" id="preference" class="form-select">
                                    <option value="">Select Preference</option>
                                    @if(!empty($all_preference) && count($all_preference) > 0)
                                        @foreach($all_preference as $preference)
                                            @if($preference->id == $menu->preference_id)
                                                <option value="{{$preference->id}}" selected>{{$preference->name}}</option>
                                            @else
                                                <option value="{{$preference->id}}">{{$preference->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="5" class="form-control" placeholder="Description">{{old('description', $menu->description)}}</textarea>
                            @error('description')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div>
                            <a href="{{route('menu.show', $menu->id)}}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-warning ms-3">
                                <i class="fa-solid fa-check"></i> Save Change
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
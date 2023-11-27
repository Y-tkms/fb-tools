@extends('layouts.app')

@section('title', 'Menu Sections $ Preference')

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="m-0">Create Section</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('menu.section.create')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-9">
                                <label for="name" class="form-label">Section Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Section Name" value="{{old('name')}}">
                                @error('name')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-3 mt-auto">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa-solid fa-check"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if(!empty($all_menu_sections) && count($all_menu_sections) > 0)
                <div class="table-responsive mt-3">
                    <table class="table table-hover align-middle text-center border">
                        <thead class="table-primary">
                            <tr>
                                <td>ID</td>
                                <td>Section Name</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach($all_menu_sections as $menu_section)
                                <tr>
                                    <td>{{$menu_section->id}}</td>
                                    <td>{{$menu_section->name}}</td>
                                    <td>
                                        <a href="{{route('menu.section.edit', ['id' => $menu_section->id, 'type' => 'section'])}}" class="btn btn-outline-secondary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-section-{{$menu_section->id}}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        @include('menu.sections&preferences.modal.section-delete')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center mt-5">
                    <h1>NO SECTION</h1>
                </div>
            @endif
        </div>
        <div class="col-6">
            <div class="card mt-3">
                <div class="card-header">
                    <h3 class="m-0">Create Preference</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('manu.preference.create')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-9">
                                <label for="name" class="form-label">Preference</label>
                                <input type="text" class="form-control" name="preference" id="preference" placeholder="Preference" value="{{old('preference')}}">
                                @error('preference')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-3 mt-auto">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa-solid fa-check"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if(!empty($all_menu_preference) && count($all_menu_preference) > 0)
                <div class="table-responsive mt-3">
                    <table class="table table-hover align-middle text-center border">
                        <thead class="table-primary">
                            <tr>
                                <td>ID</td>
                                <td>Preference</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach($all_menu_preference as $menu_preference)
                                <tr>
                                    <td>{{$menu_preference->id}}</td>
                                    <td>{{$menu_preference->name}}</td>
                                    <td>
                                        <a href="{{route('menu.section.edit', ['id' => $menu_preference->id, 'type' => 'preference'])}}" class="btn btn-outline-secondary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-preference-{{$menu_preference->id}}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        @include('menu.sections&preferences.modal.preference-delete')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center mt-5">
                    <h1>NO PREFERENCE</h1>
                </div>
            @endif
        </div>
    </div>
@endsection
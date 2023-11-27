@extends('layouts.app')

@section('title', 'Show Menu')

@section('content')
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
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header d-flex">
                    <h4 class="m-0">Menu Details</h4>
                    <div class="btn-group ms-auto" role="group" aria-label="control">
                        @if(Auth::user()->role == 'a' || Auth::user()->role == 'em' || Auth::user()->role == 'emr')
                            <a href="{{route('menu.index')}}" class="btn btn-secondary ">
                                <i class="fa-solid fa-arrow-left"></i>
                            </a>
                            <a href="{{route('menu.edit', $menu->id)}}" class="btn btn-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        @else
                            <a href="{{route('menu.index')}}" class="btn btn-secondary ">
                                <i class="fa-solid fa-arrow-left"></i> Back
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody class="table-group-divider">
                                <tr>
                                    <td class="fw-bold">Name</td>
                                    <td>
                                        @if($menu->name)
                                            {{$menu->name}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Price</td>
                                    <td>
                                        @if($menu->price)
                                            ¥ {{number_format($menu->price)}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Section</td>
                                    <td>
                                        @if($menu->section_id)
                                            {{$menu->section->name}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Preference</td>
                                    <td>
                                        @if($menu->preference_id)
                                            {{$menu->preference->name}}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Description</td>
                                    <td>
                                        @if($menu->description)
                                            {{$menu->description}}
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(Auth::user()->role == 'a' || Auth::user()->role == 'em' || Auth::user()->role == 'emr')
                    <div class="card-footer">
                        <form action="{{route('menu.hide', $menu->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger w-100 my-2 py-3">
                                <h4 class="m-0"><i class="fa-solid fa-trash-can"></i> Delete</h4>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
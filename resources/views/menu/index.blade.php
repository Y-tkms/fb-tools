@extends('layouts.app')

@section('title', 'Menu Index')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h3 class="">- Menu -</h3>
        </div>
        <div class="col-md-6">
            <a href="{{route('menu.create')}}" class="btn btn-primary ms-auto w-100 text-nowrap">Create Menu</a>
        </div>
    </div>
    @if(!empty($all_menu) && count($all_menu) > 0)
        @if(!empty($all_menu_section) && count($all_menu_section) > 0)
            @foreach($all_menu_section as $section)
                <div>
                    <h3>{{$section->name}}</h3>
                    @if(!empty($section->menus) && count($section->menus) > 0)
                        <div class="row mb-2">
                            @foreach($all_menu as $menu)
                                @if($menu->section_id == $section->id && $menu->status == 1)
                                    <div class="col-sm-3 mb-3">
                                        <a href="{{route('menu.show', $menu->id)}}" class="btn btn-outline-dark w-100 fw-bold text-truncate">{{$menu->name}}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p class="text-danger">No {{$section->name}}</p>
                    @endif
                </div>
            @endforeach
        @else
            <div class="text-center">No Section</div>
        @endif
        <h3>Menu with no section</h3>
        @if(!empty($menu_no_section) && count($menu_no_section) > 0)
            <div class="row mb-2">
                @foreach($menu_no_section as $menu)
                    @if($menu->status == 1)
                        <div class="col-md-3">
                            <a href="{{route('menu.show', $menu->id)}}" class="btn btn-outline-dark w-100 fw-bold text-truncate">{{$menu->name}}</a>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    @else
        <h1 class="text-center mt-5">NO MENU</h1>
    @endif
@endsection
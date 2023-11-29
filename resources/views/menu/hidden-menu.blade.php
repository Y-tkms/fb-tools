@extends('layouts.app')

@section('title', 'Inactive Menu')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <h3 class="">- Inactive Menu -</h3>
            @if(!empty($all_menu) && count($all_menu) > 0)
                @if(!empty($all_menu_section) && count($all_menu_section) > 0)
                    @foreach($all_menu_section as $section)
                        <div class="mt-3">
                            <h3>{{$section->name}}</h3>
                            @if(!empty($section->menus) && count($section->menus) > 0)
                                <ul class="list-group">
                                    @foreach($all_menu as $menu)
                                        @if($menu->section_id == $section->id)
                                            <li class="list-group-item border-dark">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <h3 class="mb-0 ms-3">{{$menu->name}}</h3>
                                                    </div>
                                                    <div class="col-2">
                                                        <form action="#" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-outline-secondary w-100">Activate</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="text-center">No Section</div>
                @endif
                <h3 class="mt-3">Menu with no section</h3>
                @if(!empty($menu_no_section) && count($menu_no_section) > 0)
                    <ul class="list-group">
                        @foreach($menu_no_section as $menu)
                            <li class="list-group-item border-dark">
                                <div class="row">
                                    <div class="col-10">
                                        <h3 class="mb-0 ms-3">{{$menu->name}}</h3>
                                    </div>
                                    <div class="col-2">
                                        <form action="{{route('menu.activate', $menu->id)}}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-secondary w-100">Activate</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            @else
                <h1 class="text-center mt-5">NO MENU</h1>
            @endif
        </div>
    </div>
@endsection
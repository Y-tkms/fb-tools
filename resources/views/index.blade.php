@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row justify-content-center my-5">
        <div class="col-md-4 mb-4">
            <a href="{{route('rsv.regular.index')}}" class="btn btn-outline-success w-100">
                <h1 class="my-5">Regular</h1>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="{{route('rsv.arrangement.index')}}" class="btn btn-outline-success w-100">
                <h1 class="my-5">Arrengement</h1>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="{{route('rsv.course.index')}}" class="btn btn-outline-success w-100">
                <h1 class="my-5">Course</h1>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="{{route('rsv.xmas.index')}}" class="btn btn-outline-success w-100">
                <h1 class="my-5">Christmas</h1>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="{{route('rsv.newyear.index')}}" class="btn btn-outline-success w-100">
                <h1 class="my-5">New Year</h1>
            </a>
        </div>
    </div>
@endsection

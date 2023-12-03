@extends('layouts.app')

@section('title', 'New Year Edit')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center text-danger mb-5">
                <i class="fa-solid fa-triangle-exclamation fa-10x"></i><br>
                <h1>RESET ALL</h1>
                <h3 class="text-dark mb-3">Are you sure you want to reset all reservation?</h3>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <a href="{{route('rsv.newyear.show', ['type' => $type])}}" class="btn btn-outline-secondary w-100">Cancel</a>
                </div>
                <div class="col-md-6 mb-3">
                    <form action="{{route('rsv.newyear.reset', ['type' => $type])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-outline-danger w-100">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
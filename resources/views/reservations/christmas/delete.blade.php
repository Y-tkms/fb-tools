@extends('layouts.app')

@section('title', 'Christmas Edit')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center text-danger">
                <i class="fa-solid fa-triangle-exclamation fa-10x"></i><br>
                <h1>DELETE</h1>
                <h2>Guest Name: <span class="fw-bold">{{$reservation->guest_name}}</span></h2>
                <h3 class="text-dark mb-3">Are you sure you want to delete this reservation?</h3>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <a href="{{route('rsv.xmas.edit', $reservation->id)}}" class="btn btn-outline-secondary w-100">Cancel</a>
                </div>
                <div class="col-md-6 mb-3">
                    <form action="{{route('rsv.xmas.deactivate', $reservation->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-outline-danger w-100">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
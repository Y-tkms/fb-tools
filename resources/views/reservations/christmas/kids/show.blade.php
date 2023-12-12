@extends('layouts.app')

@section('title', 'Christmas Kids')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4"><h3 class="mb-0">Children</h3></div>
                    <div class="col-md-8 text-end"><h3 class="mb-0">- for Christmas -</h3></div>
                </div>
            </div>
            <div class="card-body">
                @foreach($kids as $kid)
                    @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                        <a href="{{route('rsv.xmas.kid.edit', $kid->id)}}" class="btn btn-outline-warning w-100 text-dark mb-3">
                            <p class="mb-0">Age: {{$kid->age}}</p>
                            <p class="mb-0">Information: {{$kid->info}}</p>
                        </a>
                    @else
                        <p>Age: {{$kid->age}}</p>
                        <p>Information: {{$kid->info}}</p>
                        <hr>
                    @endif
                @endforeach
                <a href="{{route('rsv.xmas.edit', $id)}}" class="btn btn-secondary w-100">Back/a>
            </div>
            @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                <div class="card-footer">
                    <form action="{{route('rsv.xmas.add', $id)}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">Add 1 child</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
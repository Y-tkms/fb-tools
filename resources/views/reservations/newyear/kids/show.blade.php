@extends('layouts.app')

@section('title', 'New Year Kids')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h3 class="mb-0">Children</h3></div>
                    @if($type == 'dec')
                        <div class="col-md-6 text-end"><h3 class="mb-0">- for New Year 12/31 -</h3></div>
                    @else
                        <div class="col-md-6 text-end"><h3 class="mb-0">- for New Year 1/1 -</h3></div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                @foreach($kids as $kid)
                    @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                        <a href="{{route('rsv.newyear.kid.edit', ['id' => $kid->id, 'type' => $type])}}" class="btn btn-outline-warning w-100 text-dark mb-3">
                            <p class="mb-0">Age: {{$kid->age}}</p>
                            <p class="mb-0">Information: {{$kid->info}}</p>
                        </a>
                    @else
                        <p>Age: {{$kid->age}}</p>
                        <p>Information: {{$kid->info}}</p>
                        <hr>
                    @endif
                @endforeach
                <a href="{{route('rsv.newyear.edit', ['id' => $id, 'type' => $type])}}" class="btn btn-secondary w-100">Back</a>
            </div>
            @if(Auth::user()->role == 'a' || Auth::user()->role == 'er' || Auth::user()->role == 'emr')
                <div class="card-footer">
                    <form action="{{route('rsv.newyear.kid.add', $id)}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">Add 1 child</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'Delete Section')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center text-danger">
                <i class="fa-solid fa-triangle-exclamation fa-10x"></i><br>
                <h1>DELETE</h1>
                <p>Section: <span class="fw-bold">{{$section->name}}</span></p>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <a href="{{route('rsv.set.sec.index')}}" class="btn btn-outline-secondary w-100">Cancel</a>
                </div>
                <div class="col-md-6 mb-3">
                    <form action="{{route('rsv.set.sec.deactivate', $section->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-outline-danger w-100">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
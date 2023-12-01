@extends('layouts.app')

@section('title', 'RSV Setting')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <a href="{{route('rsv.set.sec.index')}}" class="btn btn-outline-primary w-100">RSV Section List</a>
                </div>
                <div class="col-md-6 mb-4">
                    <a href="{{route('rsv.set.date.index')}}" class="btn btn-outline-primary w-100">Christmas Date</a>
                </div>
                <div class="col-md-6 mb-4">
                    <a href="{{route('rsv.set.arr.index')}}" class="btn btn-outline-primary w-100">Arrengement Item</a>
                </div>
                @if(Auth::user()->role == "a")
                    <div class="col-md-6 mb-4">
                        <a href="{{route('rsv.set.menu.index')}}" class="btn btn-outline-primary w-100">Menu for Reservation</a>
                    </div>
                    <div class="col-md-6 mb-4">
                        <a href="{{route('rsv.set.time.index')}}" class="btn btn-outline-primary w-100">Time of 12/31 & 1/1</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
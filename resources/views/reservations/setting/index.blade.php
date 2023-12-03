@extends('layouts.app')

@section('title', 'RSV Setting')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6 mb-4">
                    <a href="{{route('rsv.set.sec.index')}}" class="btn btn-outline-primary w-100"><h1 class="py-3">RSV Section List</h1></a>
                </div>
                <div class="col-md-6 mb-4">
                    <a href="{{route('rsv.set.date.index')}}" class="btn btn-outline-primary w-100"><h1 class="py-3">Christmas Date</h1></a>
                </div>
                <div class="col-md-6 mb-4">
                    <a href="{{route('rsv.set.arr.index')}}" class="btn btn-outline-primary w-100"><h1 class="py-3">Arrengement Item</h1></a>
                </div>
                @if(Auth::user()->role == "a")
                    <div class="col-md-6 mb-4">
                        <a href="{{route('rsv.set.menu.index')}}" class="btn btn-outline-primary w-100"><h1 class="py-3">Menu for RSV</h1></a>
                    </div>
                    <div class="col-md-6 mb-4">
                        <a href="{{route('rsv.set.time.index')}}" class="btn btn-outline-primary w-100"><h1 class="py-3">Time of 12/31 & 1/1</h1></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
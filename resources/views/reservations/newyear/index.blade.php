@extends('layouts.app')

@section('title', 'New Year')

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3><i class="fa-solid fa-mountain-sun"></i> New Year Order</h3>
                <div class="row justify-content-center">
                    <div class="col-md-8 pt-5">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{route('rsv.newyear.show', ['type' => 'dec'])}}" class="btn btn-outline-primary w-100 py-3">
                                    <h1>12/31</h1>
                                    <h1 class="text-dark">{{$dec_max - $dec_total}} / {{$dec_max}} remaining</h1>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('rsv.newyear.show', ['type' => 'jan'])}}" class="btn btn-outline-primary w-100  py-3">
                                    <h1>1/1</h1>
                                    <h1 class="text-dark">{{$jan_max - $jan_total}} / {{$jan_max}} remaining</h1>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
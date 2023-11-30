@extends('layouts.app')

@section('title', 'Calculator')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header d-flex">
                    <h3>Order Calculator <span class="text-muted">(Tax: 10% / SVC: 18%)</span></h3>
                    <a href="{{route('other.offline')}}" class="btn btn-secondary ms-auto px-5">Refresh</a>
                </div>
                <div class="card-body">
                    <form action="{{route('other.field')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <input type="number" name="number" class="form-control" placeholder="Enter the number of input fields" value="{{old('number')}}">
                                @error('number')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col text-center mt-2">
                                <i class="me-4 fw-bold">Exclude:</i>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="tax" name="exclude[]" value="tax">
                                    <label class="form-check-label" for="svc">TAX</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="svc" name="exclude[]" value="svc">
                                    <label class="form-check-label" for="svc">SVC</label>
                                </div>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-outline-primary w-100">Create Input Fields</button>
                            </div>
                        </div>
                    </form>
                </div>
                @if(isset($result))
                    <div class="card-footer">
                        <form action="{{route('other.order')}}" method="POST">
                            @csrf
                            <div>
                                @for($i = 1; $i <= $result; $i++)
                                    <div class="row">
                                        <div class="col">
                                            <label for="menu" class="form-label">Menu</label>
                                            <select name="menu[]" id="menu" class="form-select">
                                                <option value="none" class="none">Manual Entry</option>
                                                @if(count($all_menus) > 0)
                                                    @foreach($all_menus as $menu)
                                                        <option value="{{$menu->id}}">{{$menu->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="name" class="form-label">Menu Name</label>
                                            <input type="text" class="form-control" name="name[]" id="name">
                                        </div>
                                        <div class="col">
                                            <label for="price" class="form-label">Menu Price <i class="text-danger small">*include Tax & SVC</i></label>
                                            <input type="number" class="form-control" name="price[]" id="price">
                                        </div>
                                        <div class="col">
                                            <label for="amount" class="form-label">Amount <i class="text-danger small">*required</i></label>
                                            <input type="number" class="form-control" name="amount[]" id="amount">
                                        </div>
                                        <hr class="mt-3">
                                    </div>
                                @endfor
                                <button class="btn btn-primary w-100" type="submit">Calculate</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
            @if(isset($final))
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h3>Result <span class="text-danger small ms-3">({{$note}})</span></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @for($i = 0; $i < $final; $i++)
                                        <div class="col-2">{{$amount[$i]}} x</div>
                                        @if($menu[$i] == null)
                                            <div class="col-7">(NO NAME)</div>
                                        @else
                                            <div class="col-7">{{$menu[$i]}}</div>
                                        @endif
                                        <div class="col-3 text-end">¥{{number_format(round($amount[$i] * $price[$i]))}}</div>
                                    @endfor
                                </div>
                                <div class="text-end mt-5">
                                    <p class="mb-0">Subtotal <span class="ms-3">¥{{number_format(round($subtotal))}}</span></p>
                                    <p class="mb-0">Service Charge 18% <span class="ms-3">¥{{number_format(round($svc))}}</span></p>
                                    <p class="mb-0">Tax 10% <span class="ms-3">¥{{number_format(round($tax))}}</span></p>
                                    <h3 class="mt-3">TOTAL <span class="ms-3">¥{{number_format(round($total))}}</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
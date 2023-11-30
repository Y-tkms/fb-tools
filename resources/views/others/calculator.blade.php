@extends('layouts.app')

@section('title', 'Calculator')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header d-flex">
                    <h3>Price Calculator</h3>
                    {{-- <a href="{{route('other.calculator')}}" class="btn btn-secondary ms-auto px-5">Refresh</a> --}}
                </div>
                <div class="card-body">
                    <form action="{{route('other.calculate')}}" method="POST">
                        @csrf
                        <div>
                            <div class="row">
                                <div class="col">
                                    <input type="radio" class="btn-check" name="type" id="cal" autocomplete="off" value="cal" checked>
                                    <label class="btn btn-outline-primary w-100" for="cal">Convert Price </label>
                                    <div class="mt-2 row">
                                        <div class="col-3 text-end">
                                            <span class="fw-bold">SVC</span>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="svc" id="svc18" value="18" checked>
                                                <label class="form-check-label" for="svc18">18%</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="svc" id="svc16" value="16">
                                                <label class="form-check-label" for="svc16">16%</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="svc" id="svc0" value="0">
                                                <label class="form-check-label" for="svc0">None</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 text-end">
                                            <span class="fw-bold">TAX</span>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tax" id="tax10" value="10" checked>
                                                <label class="form-check-label" for="tax10">10%</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tax" id="tax8" value="8">
                                                <label class="form-check-label" for="tax8">8%</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tax" id="tax0" value="0">
                                                <label class="form-check-label" for="tax0">None</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3 text-end">
                                            <span class="fw-bold">Convert</span>
                                        </div>
                                        <div class="col-9">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="formula" id="add" value="add" checked>
                                                <label class="form-check-label" for="add">Add</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="formula" id="remove" value="remove">
                                                <label class="form-check-label" for="remove">Remove</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <input type="radio" class="btn-check" name="type" id="svc" autocomplete="off" value="svc">
                                    <label class="btn btn-outline-primary w-100" for="svc">Convert SVC</label>
                                    <div class="text-end">
                                        <i class="text-danger">*Tax will be 10%</i>
                                    </div>
                                    <div class="mt-2 row">
                                        <div class="col-2 text-end">
                                            <span class="fw-bold">SVC</span>
                                        </div>
                                        <div class="col-10">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="way" id="to18" value="18" checked>
                                                <label class="form-check-label" for="to18">16% => 18%</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="way" id="to16" value="16">
                                                <label class="form-check-label" for="to16">18% => 16%</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="price" class="form-label">Price</label>
                            <div class="row">
                                <div class="col-9">
                                    <input type="number" name="price" id="price" class="form-control" placeholder="Enter price here" value="{{old('price')}}" autofocus>
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary w-100">Calculate</button>
                                </div>
                                @error('price')
                                    <p class="text-warning small">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                @if(isset($result))
                    <div class="card-footer">
                        <div class="row mt-2">
                            @if($status == "add")
                                <div class="col-4 text-center">
                                    <h5 class="fw-light">Total Price: <span class="fw-bold">¥{{number_format($total)}}</span></h5>
                                </div>
                                <div class="col-8">
                                    <p>(you entered ¥{{number_format($initial)}} / {{$note}})</p>
                                </div>
                            @else
                                <div class="col-5 text-center">
                                    <h5 class="fw-light">Price without TAX and SVC: <span class="fw-bold">¥{{number_format($total)}}</span></h5>
                                </div>
                                <div class="col-7">
                                    <p>(you entered ¥{{number_format($initial)}} | {{$note}})</p>
                                </div>
                            @endif
                        </div>
                        <div class="row text-center">
                            <div class="col-4">
                                <p class="text-muted mb-0">Input Price: ¥{{number_format($input)}}</p>
                            </div>
                            <div class="col-4">
                                <p class="text-muted mb-0">TAX: ¥{{number_format($tax)}} ({{$pertax}})</p>
                            </div>
                            <div class="col-4">
                                <p class="text-muted mb-0">SVC: ¥{{number_format($svc)}} ({{$persvc}})</p>
                            </div>
                        </div>
                        @if($pertax == "10%" && $persvc == "18%")
                            <div class="mt-4">
                                <form action="{{route('other.store')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="name" class="form-control border-dark" placeholder="Enter item name" value="{{old('name')}}">
                                            @if($status == "add")
                                                <input type="number" class="form-control mt-2 border-dark" name="price" value="{{$total}}" readonly>
                                            @else
                                                <input type="number" class="form-control mt-2 border-dark" name="price" value="{{$initial}}" readonly>
                                            @endif
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-outline-primary w-100 h-100"><h1 class="mb-0">Keep Item</h1></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
            @if(count($all_items) > 0)
                <div class="table-responsive mt-5">
                    <table class="table table-striped table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Name :</th>
                                <th>Total Price =</th>
                                <th>Input Price +</th>
                                <th>SVC +</th>
                                <th>TAX</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach($all_items as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{round($item->price)}}</td>
                                    <td>{{round($item->price - (($item->price / 110) * 10) - ((($item->price - (($item->price / 110) * 10)) / 118) * 18))}}</td>
                                    <td>{{round(($item->price / 110) * 10)}}</td>
                                    <td>{{round((($item->price - (($item->price / 110) * 10)) / 118) * 18)}}</td>
                                    <td>
                                        <form action="{{route('other.destroy', $item->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
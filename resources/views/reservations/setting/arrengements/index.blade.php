@extends('layouts.app')

@section('title', 'Arrengement')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{route('rsv.set.arr.store')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6"><h3 class="m-0">Arrengement Item</h3></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label for="name" class="form-label">Item Name</label>
                            <div class="col-md-6 mb-2">
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" autofocus>
                                @error('name')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <button type="submit" class="btn btn-primary w-100">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @if(count($items) > 0)
                <div class="row justify-content-center">
                    <div class="table-responsive mt-4">
                        <table class="table align-middle table-hover border text-center">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>
                                            <a href="{{route('rsv.set.arr.edit', $item->id)}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="{{route('rsv.set.arr.delete', $item->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="mt-3 text-center">
                    <h1>No Item</h1>
                </div>
            @endif
        </div>
    </div>
@endsection
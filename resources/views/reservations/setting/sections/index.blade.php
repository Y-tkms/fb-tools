@extends('layouts.app')

@section('title', 'RSV Section')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{route('rsv.set.sec.store')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3>RSV Section</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <label for="name" class="form-label">Section Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                            @error('name')
                                <p class="text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <label for="max" class="form-label">Maximun</label>
                            <div class="col-md-6 mb-2">
                                <input type="number" name="max" id="max" class="form-control" value="{{old('max')}}" placeholder="Enter Maximun Number">
                            </div>
                            <div class="col-md-6 mb-2">
                                <button type="submit" class="btn btn-primary w-100">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @if(count($all_sections) > 0)
                <div class="table-responsive mt-4">
                    <table class="table align-middle table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Section Name</th>
                                <th>Maximum</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_sections as $section)
                                <tr>
                                    <td>{{$section->id}}</td>
                                    <td>{{$section->name}}</td>
                                    <td>{{$section->max}}</td>
                                    <td>
                                        <a href="{{route('rsv.set.sec.edit', $section->id)}}" class="btn btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="mt-3 text-center">
                    <h1>No Section</h1>
                </div>
            @endif
        </div>
    </div>
@endsection
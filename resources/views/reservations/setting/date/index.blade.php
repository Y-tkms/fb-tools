@extends('layouts.app')

@section('title', 'RSV Date')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{route('rsv.set.date.store')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6"><h3 class="m-0">Christmas Date</h3></div>
                            <div class="col-md-6 text-end"><h3 class="m-0 fw-bold">- in {{$year}} -</h3></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <label for="date" class="form-label">Create Date</label>
                            <div class="col-md-6 mb-2">
                                <input type="date" name="date" id="date" class="form-control" value="{{old('date')}}">
                                @error('date')
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
            @if(count($all_date) > 0)
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="table-responsive mt-4">
                            <table class="table align-middle table-hover border">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th colspan="2">DATE LIST in {{$year}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_date as $date)
                                        <tr>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($date->date)->format('F jS, Y') }}</td>
                                            <td>
                                                <a href="{{route('rsv.set.date.edit', $date->id)}}" class="btn btn-warning w-100">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-3 text-center">
                    <h1>No Date</h1>
                </div>
            @endif
        </div>
    </div>
@endsection
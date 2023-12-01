@extends('layouts.app')

@section('title', 'RSV Time')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{route('rsv.set.time.store')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3>Delivery Time of 12/31 & 1/1</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="time" class="form-label">Delivery Time</label>
                                <input type="time" name="time" id="time" class="form-control" value="{{old('time')}}" autofocus>
                                @error('time')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="section" class="form-label">Date</label>
                                <select name="section" id="section" class="form-select">
                                    <option value="" disabled selected>-- Select Section --</option>
                                    @foreach($sections as $section)
                                        <option value="{{$section->id}}">{{$section->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary w-100">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive mt-4">
                        <table class="table align-middle table-hover text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>December 31st</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dec as $time)
                                    <tr>
                                        <td class="fw-bold">{{ \Carbon\Carbon::parse($time->time)->format('H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="table-responsive mt-4">
                        <table class="table align-middle table-hover text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>January 1st</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jan as $time)
                                    <tr>
                                        <td class="fw-bold">{{ \Carbon\Carbon::parse($time->time)->format('H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
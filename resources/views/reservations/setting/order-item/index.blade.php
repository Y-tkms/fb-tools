@extends('layouts.app')

@section('title', 'RSV Time')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{route('rsv.set.menu.store')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h3>Special Item for Festive Season</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Menu Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" autofocus>
                                @error('name')
                                    <p class="text-danger small">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="section" class="form-label">Section</label>
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
            <div class="table-responsive mt-4">
                <table class="table align-middle table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Menu Name</th>
                            <th>Section</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td class="fw-bold">{{$item->name}}</td>
                                <td class="fw-bold">{{$item->rsvSection->name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
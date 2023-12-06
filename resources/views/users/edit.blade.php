@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1><i class="fa-solid fa-users"></i> Admin</h1>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6"><h3>Edit User</h3></div>
                                <div class="col-6 text-end"><a href="{{route('user.index')}}" class="btn btn-secondary">Cancel</a></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('user.update', $user->id)}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Username</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{old('name', $user->name)}}" required>
                                    @error('name')
                                        <p class="text-danger small">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="row">
                                    <label for="auth" class="form-label">Authority</label>
                                    <div class="col-md-6">
                                        <select name="auth" id="auth" class="form-select">
                                            <option value="u">None</option>
                                            <option value="er">Reservation</option>
                                            <option value="em">Menu</option>
                                            <option value="emr">Reservation / Menu</option>
                                            <option value="a">Admin</option>
                                        </select>
                                        @error('auth')
                                        <p class="text-danger small">{{$message}}</p>
                                    @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary w-100">Save Change</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
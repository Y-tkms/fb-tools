@extends('layouts.app')

@section('title', 'Admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-6"><h1><i class="fa-solid fa-users"></i> Admin</h1></div>
                <div class="col-6 text-end"><a href="{{ route('register') }}" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i> Create User</a></div>
            </div>
            <div class="table-responsive">
                <table class="table align-middle table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Authority</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_user as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                @if($user->role == 'a')
                                    <td>Admin</td>
                                @elseif($user->role == 'emr')
                                    <td>Menu / Reservation</td>
                                @elseif($user->role == 'em')
                                    <td>Menu</td>
                                @elseif($user->role == 'er')
                                    <td>Reservation</td>
                                @else
                                    <td>None</td>
                                @endif
                                <td>
                                    <a href="{{route('user.edit', $user->id)}}" class="btn btn-outline-warning border-0"><i class="fa-solid fa-user-pen"></i></a>
                                    <a href="{{route('user.delete', $user->id)}}" class="btn btn-outline-danger border-0"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
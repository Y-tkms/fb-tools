@extends('layouts.app')

@section('title', 'Arrangement Item')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h3 class="mb-0">Items</h3></div>
                    <div class="col-md-6 text-end"><h3 class="mb-0">- for Arrangement -</h3></div>
                </div>
            </div>
            <div class="card-body">
                @foreach($items as $item)
                    <a href="{{route('rsv.arrangement.item.edit', $item->id)}}" class="btn btn-outline-warning w-100 text-dark mb-3">
                        @if($item->arr_item_id)
                            <p class="mb-0">Name: {{$item->arr_item->name}}</p>
                        @elseif($item->other_item)
                            <p class="mb-0">Name: {{$item->other_item}}</p>
                        @else
                            <p class="mb-0">Name: </p>
                        @endif
                        <p class="mb-0">Information: {{$item->information}}</p>
                    </a>
                @endforeach
                <a href="{{route('rsv.arrangement.edit', $id)}}" class="btn btn-secondary w-100">Back to edit page</a>
            </div>
            <div class="card-footer">
                <form action="{{route('rsv.arrangement.add', $id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success w-100">Add 1 item</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('title', 'New Year Kids')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6"><h3 class="mb-0">Edit Item</h3></div>
                    <div class="col-md-6 text-end"><h3 class="mb-0">- for Arrangement -</h3></div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{route('rsv.arrangement.item.update', $arrangement->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-">
                        <label for="main" class="formcomtrol">Main Item</label>
                        <select name="main" id="main" class="form-control">
                            <option value="">-- Select Item --</option>
                            @foreach($items as $item)
                                @if($arrangement->arr_item_id == $item->id)
                                    <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                @else
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="other" class="form-label">Other Item</label>
                        <input type="text" name="other" id="other" class="form-control" value="{{old('other', $arrangement->other_item)}}">
                    </div>
                    <div class="mb-3">
                        <label for="info" class="form-label">Information</label>
                        <textarea name="info" id="info" rows="1" class="form-control">{{old('info', $arrangement->information)}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 text-dark">Save Change</button>
                </form>
            </div>
            <div class="card-footer">
                <form action="{{route('rsv.arrangement.destroy', $arrangement->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
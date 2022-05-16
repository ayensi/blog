@extends('admin.layout.master')
@section('content')
    <form method="post" action="{{route('admin.CategoryEdit')}}">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="name" class="form-label">Category name</label>
            <input style="background-color: black;color: white" type="text" class="form-control" id="name" name="name" aria-describedby="text">
            <input type="hidden" value="{{$id}}" name="id">
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
@endsection

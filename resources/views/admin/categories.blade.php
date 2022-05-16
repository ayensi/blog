@extends('admin.layout.master')
@section('content')
    <a type="submit" href="{{route('admin.newCategoryIndex')}}" class="btn btn-dark">New Category</a>
    <br>
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif
    @if(count($categories)!=0)
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category Name</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{$category->id}}</th>
                    <td>{{$category->category_name}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                    <td>
                        <form method="get" action="{{route('admin.categoryEdit')}}">
                            @csrf

                            <input type="hidden" name="id" value={{$category->id}}>
                            <button type="submit" class="btn btn-dark">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{route('admin.categoryDestroy')}}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" value={{$category->id}}>
                            <button type="submit" class="btn btn-dark">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
    @endif



@endsection

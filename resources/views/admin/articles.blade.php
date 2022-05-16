@extends('admin.layout.master')
@section('content')

    <a type="submit" href="{{route('admin.newArticleIndex')}}" class="btn btn-dark">New Article</a>
    <br>
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif
    @if(count($articles)!=0)
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Article Name</th>
                <th scope="col">Article Image</th>
                <th scope="col">Article Category</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($articles as $article)
                <tr>
                    <th scope="row">{{$article->id}}</th>
                    <td>{{$article->article_name}}</td>
                    <td><img width="50" height="50" src="{{ asset($article->article_image) }}"></td>
                    <td>
                        @foreach($article->categories as $c)
                            {{$c->category_name}},
                        @endforeach
                    </td>


                    <td>
                        <form method="get" action="{{route('admin.articleEdit')}}">
                            @csrf

                            <input type="hidden" name="id" value={{$article->id}}>
                            <button type="submit" class="btn btn-dark">Edit</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{route('admin.articleDestroy')}}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" value={{$article->id}}>
                            <button type="submit" class="btn btn-dark">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
    @endif



@endsection

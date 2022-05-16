@extends('admin.layout.master')
@section('content')

    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif
    @if(count($comments)!=0)
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Comment Owner</th>
                <th scope="col">Comment Article Name</th>
                <th scope="col">Comment</th>
                <th scope="col">Comment Like</th>
                <th scope="col">Delete Comment</th>
                <th scope="col">Ban Comment Owner</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($comments as $comment)
                <tr>
                    <th scope="row">{{$comment->id}}</th>
                    <td>{{$comment->user->name}}</td>
                    <td>{{$comment->article->article_name}}</td>
                    <td>{{$comment->comment}}</td>
                    <td>{{$comment->likes}}</td>
                    <td><form method="post" action="{{route('admin.commentDestroy')}}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" value={{$comment->id}}>
                            <button type="submit" class="btn btn-dark">Delete</button>
                        </form></td>
                    <td><form method="post" action="{{route('admin.commentUserBan')}}">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id" value={{$comment->user->id}}>
                            <button type="submit" class="btn btn-danger">Ban</button>
                        </form></td>

                </tr>
            @endforeach


            </tbody>
        </table>
    @endif
@endsection

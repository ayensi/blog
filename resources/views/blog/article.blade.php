@extends('layouts.bloglayout')
@section('content')
<head>
    <script>
        function toggleReplyDiv(id){
            $('#replydiv'+id).slideToggle();
        }
    </script>
    <style>
        .card {
            border: none;
            box-shadow: 5px 6px 6px 2px #e9ecef;
            border-radius: 4px
        }

        .dots {
            height: 4px;
            width: 4px;
            margin-bottom: 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block
        }

        .badge {
            padding: 7px;
            padding-right: 9px;
            padding-left: 16px;
            box-shadow: 5px 6px 6px 2px #e9ecef
        }

        .user-img {
            margin-top: 4px
        }

        .check-icon {
            font-size: 17px;
            color: #c3bfbf;
            top: 1px;
            position: relative;
            margin-left: 3px
        }

        .form-check-input {
            margin-top: 6px;
            margin-left: -24px !important;
            cursor: pointer
        }

        .form-check-input:focus {
            box-shadow: none
        }

        .icons i {
            margin-left: 8px
        }

        .reply {
            margin-left: 12px
        }

        .reply small {
            color: #b7b4b4
        }

        .reply small:hover {
            color: green;
            cursor: pointer
        }
    </style>
</head>
    <div class="container ct-u-paddingTop40 ct-u-paddingBottom100">
        <div class="dynamicDiv" id="dd.0.1.0"></div>
        <div class="row">
            <div class="col-md-12 ct-content">
                <div class="dynamicDiv" id="dd.0.1.1">
                    <div class="blog-wrapper">
                        <h1>
                            {{$article->article_name}}
                        </h1>
                        <div style="text-align: center">
                            <img height="400" max-width="600" alt="blog-2.jpg" class="img-responsive pull-right blog-inner" src="{{asset($article->article_image)}}">
                        </div>

                        {!! $article->article_content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
    <br>
    <h3 class="ml-2">
        Give us a rating!
    </h3>
            <div style="margin-bottom: 60px" class="form-group required">
                <div class="col-sm-12">
                    <form class="inline-block" method="POST" action="{{route('article.rate')}}">
                        @csrf
                        <input type="hidden" value="1" name="rating">
                        <input type="hidden" value="{{$article->id}}" name="article_id">
                        <button type="submit" style="float: left" class="btn"><i class="fa-solid fa-star"></i></button>
                    </form>
                    <form class="inline-block" method="POST" action="{{route('article.rate')}}">
                        @csrf
                        <input type="hidden" value="2" name="rating">
                        <input type="hidden" value="{{$article->id}}" name="article_id">
                        <button type="submit" style="float: left" class="btn"><i class="fa-solid fa-star"></i></button>
                    </form>
                    <form class="inline-block" method="POST" action="{{route('article.rate')}}">
                        @csrf
                        <input type="hidden" value="3" name="rating">
                        <input type="hidden" value="{{$article->id}}" name="article_id">
                        <button type="submit" style="float: left" class="btn"><i class="fa-solid fa-star"></i></button>
                    </form>
                    <form class="inline-block" method="POST" action="{{route('article.rate')}}">
                        @csrf
                        <input type="hidden" value="4" name="rating">
                        <input type="hidden" value="{{$article->id}}" name="article_id">
                        <button type="submit" style="float: left" class="btn"><i class="fa-solid fa-star"></i></button>
                    </form>
                    <form class="inline-block" method="POST" action="{{route('article.rate')}}">
                        @csrf
                        <input type="hidden" value="5" name="rating">
                        <input type="hidden" value="{{$article->id}}" name="article_id">
                        <button type="submit" style="float: left" class="btn"><i class="fa-solid fa-star"></i></button>
                    </form>


                </div>
            </div>
    <div class="mt-3 col-md-8">
        <form method="post" action="{{route('article.comment')}}">
            @csrf
            <div class="form-group">
                <label for="Comment">Your comment</label>
                <textarea name="comment" class="form-control" id="commentarea" rows="4"></textarea>
            </div>
            <input type="hidden" value="{{$article->id}}" name="id">
            <div class="form-group">
                <button type="submit" class="btn btn-dark" id="commentbutton">Send</button>
            </div>
        </form>
    </div>
@if(Session::has('likeMessage'))
    <div class="alert alert-danger" role="alert">
        {{Session::get('likeMessage')}}
    </div>
@endif
    <div class="container mt-3 mb-5">
        <div class="row d-flex">
            <div class="col-md-12">
                @foreach($comments as $comment)
                    <div class="card p-3 mt-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="user d-flex flex-row align-items-center">
                                <span><small class="font-weight-bold text-primary">{{$comment->user->name}}</small><br>
                                    <small class="font-weight-bold">{{$comment->comment}}</small>
                                </span>

                            </div> <small>{{ \Carbon\Carbon::parse($comment->created_at)->format('j F, Y') }}</small>
                        </div>
                        @foreach($replies as $reply)
                            @if($reply->comment_id == $comment->id)
                                <div class="d-flex justify-content-between align-items-center ml-4">
                                    <div class="user d-flex flex-row align-items-center">
                                        <br>
                                        <br>
                                        <span><small class="font-weight-bold text-secondary">{{$reply->user->name}} </small><small class="font-weight-light">replied:</small><br>
                                    <small class="font-weight-bold">{{$reply->reply}}</small>
                                </span>

                                    </div> <small>{{ \Carbon\Carbon::parse($comment->created_at)->format('j F, Y') }}</small>
                                </div>
                            @endif

                        @endforeach

                        <div class="action d-flex justify-content-between mt-2 align-items-center">
                            <div class="reply"><button id="replytoggle" style="float: left" type="button" onclick="toggleReplyDiv({{$comment->id}})" class="btn"><i class="fa-solid fa-reply"></i><p>Reply</p></button>  </div>
                            <div class="icons align-items-center">
                                <form method="post" action="{{route('article.likeComment')}}">
                                    @csrf
                                    <input type="hidden" value="{{$comment->id}}" name="id">
                                    <input type="hidden" value="{{$article->id}}" name="article_id">
                                    <button class="btn" type="submit">
                                        <i class="fa-solid fa-heart"></i>
                                        <medium class="ml-1">{{$comment->likes}}
                                        </medium>
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div style="display: none" id="replydiv{{$comment->id}}" class="mt-1 col-md-6">
                        <form method="post" action="{{route('article.replyComment')}}">
                            @csrf
                            <div class="form-group">
                                <label for="Reply">Your reply</label>
                                <textarea name="reply" class="form-control" id="replyarea" rows="2"></textarea>
                            </div>
                            <input type="hidden" value="{{$article->id}}" name="article_id">
                            <input type="hidden" value="{{$comment->id}}" name="id">
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark" {{$comment->id}}">Send</button>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

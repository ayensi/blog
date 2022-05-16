@extends('layouts.bloglayout')
@section('content')

    <div style="background-image: url({{$articlesTop[0]->article_image}})" class="p-4 p-md-5 mb-4 text-white rounded">
        <div class="col-md-6 px-0">
            <h1 class="display-4 fst-italic">{{$articlesTop[0]->article_name}}</h1>
            <p class="lead my-3">{!! \Str::limit(strip_tags($articlesTop[0]->article_content),200) !!}</p>
            <p class="lead mb-0"><form method="get" action="{{route('article')}}">
                @csrf
                <button class="btn btn-dark mt-3" type="submit" class="stretched-link">Continue reading</button>
                <input type="hidden" name="article_id" value="{{$articlesTop[0]->id}}">
            </form>
            </p>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    @foreach($articlesTop[1]->categories as $c)
                        <strong class="d-inline-block mb-2 text-primary">{{$c->category_name}}</strong>
                    @endforeach
                    <h3 class="mb-0">{{$articlesTop[1]->article_name}}</h3>
                    <div class="mb-1 text-muted">{{ \Carbon\Carbon::parse($articlesTop[1]->created_at)->format('j F, Y') }}</div>
                    <p class="card-text mb-auto">{!! \Str::limit(strip_tags($articlesTop[1]->article_content),200) !!}</p>
                    <form method="get" action="{{route('article')}}">
                        @csrf
                        <button class="btn btn-dark mt-3" type="submit" class="stretched-link">Continue reading</button>
                        <input type="hidden" name="article_id" value="{{$articlesTop[1]->id}}">
                    </form>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <img width="300" height="200" src="{{asset($articlesTop[1]->article_image)}}">

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    @foreach($articlesTop[2]->categories as $c)
                        <strong class="d-inline-block mb-2 text-primary">{{$c->category_name}}</strong>
                    @endforeach
                    <h3 class="mb-0">{{$articlesTop[2]->article_name}}</h3>
                    <div class="mb-1 text-muted">{{ \Carbon\Carbon::parse($articlesTop[2]->created_at)->format('j F, Y') }}</div>
                    <p class="mb-auto">{!! \Str::limit(strip_tags($articlesTop[2]->article_content),200) !!}</p>
                    <form method="get" action="{{route('article')}}">
                        @csrf
                        <button class="btn btn-dark mt-3" type="submit" class="stretched-link">Continue reading</button>
                        <input type="hidden" name="article_id" value="{{$articlesTop[2]->id}}">
                    </form>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <img width="300" height="200" src="{{asset($articlesTop[2]->article_image)}}">

                </div>
            </div>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-md-12">
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                Articles
            </h3>

@foreach($articles as $article)
                <article>
                    <div class="col">
                        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            <div class="col p-4 d-flex flex-column position-static">
                                @foreach($article->categories as $c)
                                    <strong class="d-inline-block mb-2 text-primary">{{$c->category_name}}</strong>
                                @endforeach
                                <h3 class="mb-0">{{$article->article_name}}</h3>
                                <div class="mb-1 text-muted">{{ \Carbon\Carbon::parse($article->created_at)->format('j F, Y') }}</div>
                                {!! \Str::limit(strip_tags($article->article_content),200) !!}

                                <form method="get" action="{{route('article')}}">
                                    @csrf
                                    <button class="btn btn-dark mt-3" type="submit" class="stretched-link">Continue reading</button>
                                    <input type="hidden" name="article_id" value="{{$article->id}}">
                                </form>

                            </div>
                            <div class="col-auto d-none d-lg-block">
                                <img width="300" height="200" src="{{asset($article->article_image)}}">

                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
            <div class="d-flex justify-content-center">
                {!! $articles->links() !!}
            </div>
        </div>

@endsection

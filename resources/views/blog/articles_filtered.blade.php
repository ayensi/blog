@extends('layouts.bloglayout')
@section('content')


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
                            {!! \Str::limit(strip_tags($article->article_content),600) !!}
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
    </div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Http\Contracts\IArticleService;
use App\Models\Article;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $articleService;
    public function __construct(IArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request){
        $articles = $this->articleService->searchByKeyword($request->article_search);
        $articlesTop = $this->articleService->sortArticlesByRating()->get(3);
        return view('blog.home',compact('articles','articlesTop'));
    }

}

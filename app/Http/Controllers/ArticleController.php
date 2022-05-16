<?php

namespace App\Http\Controllers;

use App\Http\Contracts\IArticleService;
use App\Http\Contracts\ICommentService;
use App\Http\Contracts\IRatingService;
use App\Http\Contracts\IReplyService;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Rating;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class ArticleController extends Controller
{
    private $articleService;
    private $commentService;
    private $ratingService;
    private $replyService;

    public function __construct(IArticleService $articleService, ICommentService $commentService,IRatingService $ratingService,IReplyService $replyService)
    {
        $this->articleService = $articleService;
        $this->commentService = $commentService;
        $this->ratingService = $ratingService;
        $this->replyService = $replyService;
    }

    public function index(Request $request){
        $page = $request->has('page') ? $request->query('page') : 1;

        $articlesTop = Cache::remember('articles', 600, function () {
            return $this->articleService->sortArticlesByRating()->get(3);
        });
        $articles = Cache::remember('articles_page_'.$page, 600, function () {
            return $this->articleService->sortArticlesByRating()->paginate(8);
        });
        //$articlesTop = $this->articleService->sortArticlesByRating()->get(3);
        //$articles = $this->articleService->sortArticlesByRating()->paginate(8);
        return view('blog.home',compact('articles','articlesTop'));
    }
    public function article(Request $request){
        $article = $this->articleService->findById($request->article_id);
        list($comments,$replies) = $this->commentService->findByIdWithRating($request->article_id);
        return view('blog.article',compact('article','comments','replies'));
    }
    public function blogsFiltered(Request $request){
        $articles = $this->articleService->findByCategoryId($request->id);
        return view('blog.articles_filtered',compact('articles'));
    }
    public function rateArticle(Request $request){
        $article = $this->articleService->findById($request->article_id);
        $this->ratingService->rate($request->article_id,$request->rating);
        return redirect()->back()->with(compact('article'));
    }
    public function likeComment(Request $request){
        $article =$this->articleService->findById($request->article_id);
        $this->commentService->likeComment($request->id,$article);
        return redirect()->back()->with(compact('article'));
    }
    public function replyComment(Request $request){
        $article = $this->articleService->findById($request->article_id);
        $comment = $this->commentService->findById($request->id);
        $this->replyService->newReply($request->reply,$comment,$request->id);
        return redirect()->back()->with(compact('article'));
    }
    public function makeComment(Request $request){
        $article = Article::find($request->id);
        $this->commentService->newComment($request->comment,$request->id);
        return redirect()->back()->with(compact('article'));
    }






}

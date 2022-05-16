<?php

namespace App\Http\Controllers;

use App\Http\Contracts\IArticleService;
use App\Http\Contracts\ICategoryService;
use App\Http\Contracts\ICommentService;
use App\Http\Contracts\IRatingService;
use App\Http\Contracts\IReplyService;
use App\Http\Contracts\IUserService;
use App\Http\Constants;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    private $articleService;
    private $commentService;
    private $ratingService;
    private $replyService;
    private $categoryService;
    private $userService;


    public function __construct(IArticleService $articleService, ICommentService $commentService,IRatingService $ratingService,IReplyService $replyService,ICategoryService $categoryService,IUserService $userService)
    {
        $this->articleService = $articleService;
        $this->commentService = $commentService;
        $this->ratingService = $ratingService;
        $this->replyService = $replyService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    /*---------Views---------*/
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function categories(){
        $categories = $this->categoryService->all();
        return view('admin.categories',compact('categories'));
    }
    public function articles(){
        $articles = $this->articleService->all();
        $categories = $this->categoryService->all();
        return view('admin.articles',compact('articles','categories'));
    }
    public function topComments(){
        $comments = $this->commentService->all();
        return view('admin.topreviews',compact('comments'));
    }
    /*---------End Views---------*/

    /*---------Auth---------*/
    public function loginIndex(){
    return view('admin.login');
    }
    public function login(Request $request){

        $check = $request->all();

        if(Auth::guard('admin')->attempt(['email' => $check['email'],'password' => $check['password']])){
            return redirect()->route('admin.dashboard')->with('message','Successfully logged in');
        }
        else{
            return back()->with('error','Invalid email or password');
        }
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
    /*---------End Auth---------*/

    /*---------Category---------*/
    public function newCategoryIndex(){
        if(auth()->guard('admin')->user()->admin_type>2){
            return redirect()->route('admin.dashboard')->with('error','Unauthorized user.');
        }
        $categories = $this->categoryService->all();
    return view('admin.category.new',compact('categories'));
    }
    public function categoryStore(Request $request){
        if(auth()->guard('admin')->user()->admin_type>2){
            return redirect()->route('admin.dashboard')->with('error','Unauthorized user.');
        }
        $this->categoryService->new($request);
        return redirect()->route('admin.categories')->with('message','Category created successfully');
    }
    public function categoryEdit(Request $request){
        if(auth()->guard('admin')->user()->admin_type>2){
            return redirect()->route('admin.dashboard')->with('error','Unauthorized user.');
        }
        return view('admin.category.edit')->with('id',$request->id);
    }
    public function categoryUpdate(Request $request){
        if(auth()->guard('admin')->user()->admin_type>2){
            return redirect()->route('admin.dashboard')->with('error','Unauthorized user.');
        }
        $this->categoryService->update($request);
        return  redirect()->route('admin.categories')->with('message','Category edited successfully');
    }
    public function categoryDestroy(Request $request){
        if(auth()->guard('admin')->user()->admin_type>2){
            return redirect()->route('admin.dashboard')->with('error','Unauthorized user.');
        }
        $this->categoryService->destroy($request->id);
        return  redirect()->route('admin.categories')->with('message','Category deleted successfully');
    }
    /*---------End Category---------*/

    /*---------Article---------*/
    public function newArticleIndex(){
        $categories = $this->categoryService->all();
        return view('admin.article.new',compact('categories'));
    }
    public function articleStore(Request $request){
        $this->articleService->new($request);
        return  redirect()->route('admin.articles')->with('message','Article created successfully');
    }
    public function articleEdit(Request $request){
        return view('admin.article.edit')->with('id',$request->id);
    }
    public function articleUpdate(Request $request){
        $this->articleService->update($request);
        return  redirect()->route('admin.articles')->with('message','Article edited successfully');
    }
    public function articleDestroy(Request $request){
        if(auth()->guard('admin')->user()->admin_type>2){
            return redirect()->route('admin.dashboard')->with('error','Unauthorized user.');
        }
        $article = Article::find($request->id);
        $article->delete();
        return  redirect()->route('admin.articles')->with('message','Article deleted successfully');
    }
    /*---------End Article---------*/

    /*---------Comment---------*/
    public function commentDestroy(Request $request){
        if(auth()->guard('admin')->user()->admin_type>2){
            return redirect()->route('admin.dashboard')->with('error','Unauthorized user.');
        }
        $this->commentService->destroy($request->id);
        return redirect()->route('admin.topComments')->with('message','Comment deleted successfully');
    }

    public function commentUserBan(Request $request){
        if(auth()->guard('admin')->user()->admin_type>1){
            return redirect()->route('admin.dashboard')->with('error','Unauthorized user.');
        }
        $this->userService->destroy($request->id);
        return redirect()->route('admin.topComments')->with('message','Comment and user deleted successfully');
    }
    /*---------End Comment---------*/

}

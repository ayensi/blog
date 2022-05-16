<?php

namespace App\Providers;

use App\Http\Contracts\IArticleService;
use App\Http\Contracts\ICategoryService;
use App\Http\Contracts\ICommentService;
use App\Http\Contracts\IRatingService;
use App\Http\Contracts\IReplyService;
use App\Http\Contracts\IUserService;
use App\Http\Services\ArticleService;
use App\Http\Services\CategoryService;
use App\Http\Services\CommentService;
use App\Http\Services\RatingService;
use App\Http\Services\ReplyService;
use App\Http\Services\UserService;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $app = app();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IArticleService::class, ArticleService::class);
        $this->app->bind(ICommentService::class, CommentService::class);
        $this->app->bind(IReplyService::class, ReplyService::class);
        $this->app->bind(IRatingService::class, RatingService::class);
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(IUserService::class, UserService::class);

        View::composer('layouts.bloglayout', function ($view) {
            $view->with('categories', Category::all());
        });

        Paginator::useBootstrap();
    }
}

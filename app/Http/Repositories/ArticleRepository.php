<?php

namespace App\Http\Repositories;

use App\Http\Contracts\IArticleContract;
use App\Models\Article;
use App\Models\Category;

class ArticleRepository
{
    public function sortArticlesByRating()
    {
        return Article::with(['rating'])->withCount(['rating as rating' => function ($query) {
            $query->select(\DB::raw('coalesce(sum(rating), 0)'));
        }])->orderByDesc('rating');

    }

    public function findById($id){
        return Article::find($id);
    }

    public function findByCategoryId($id){
        return Category::find($id)->articles;
    }
    public function all(){
        return Article::all();
    }
    public function new($request){
        $article = new Article();
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);

        $article->article_name = $request->name;
        $article->article_content= $request->articlecontent;
        $article->article_image = "/uploads/".$imageName;

        $article->save();

        $article->categories()->attach( $request->input('categories') );
    }
    public function update($request){
        $category = Category::find($request->id);

        $category->category_name = $request->name;

        $category->save();
    }
    public function destroy($id){
        $article = Article::find($id);
        $article->delete();
    }

    public function searchByKeyword($keyword)
    {
        if($keyword){
            $articles = Article::search($keyword)
                ->paginate(8);
        }else{
            $articles = Article::paginate(8);
        }
        return $articles;

    }

}

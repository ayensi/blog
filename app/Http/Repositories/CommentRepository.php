<?php

namespace App\Http\Repositories;

use App\Models\Article;
use App\Models\Comment;

class CommentRepository
{
    public function findByArticleIdSortDesc($id){
        return Article::find($id)->comment->sortByDesc('likes');
    }
    public function findById($id){
        return Comment::find($id);
    }
    public function newComment($commentText,$articleId){
        $comment = Comment::create([
            'comment' =>$commentText,
            'article_id' =>$articleId,
            'user_id' => auth()->id(),
            'likes' => 0
        ]);
        $comment->save();
    }
    public function all(){
        return Comment::all()->sortByDesc('likes');
    }
    public function destroy($id){
        $comment = Comment::find($id);
        $comment->delete();
    }
}

<?php

namespace App\Http\Services;

use App\Http\Contracts\ICommentService;
use App\Http\Repositories\CommentRepository;
use App\Models\Comment;
use App\Models\Like;

class CommentService implements ICommentService
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function findByIdWithRating($id)
    {
        $comments = $this->commentRepository->findByArticleIdSortDesc($id);

        $replies = [];
        $i=0;
        foreach ($comments as $comment){
            $reply = Comment::find($comment->id)->reply->all();
            if($reply){
                foreach ($reply as $r){
                    $replies[$i] = $r;
                    $i+=1;
                }
            }
        }
        return [$comments, $replies];
    }

    public function findById($id)
    {
        return $this->commentRepository->findById($id);
    }

    public function likeComment($id, $article)
    {
        $comment = $this->findById($id);

        if($comment->user_id==auth()->id()){
            return redirect()->back()->with('likeMessage','You can not like your own comment.')->with(compact('article'));
        }
        $likes = Like::where('comment_id',$id)
            ->where('user_id',auth()->id())->first();
        if(!$likes){
            $comment->likes +=1;
            $comment->save();

            $likes = new Like();
            $likes->comment_id =$id;
            $likes->user_id =auth()->id();
            $likes->save();
        }
        else{
            $likes->delete();
            $comment->likes -=1;
            $comment->save();
        }
    }

    public function newComment($comment, $articleId)
    {
        $this->commentRepository->newComment($comment,$articleId);
    }

    public function all()
    {
        return $this->commentRepository->all();
    }
    public function destroy($id)
    {
        $this->commentRepository->delete($id);
    }
}

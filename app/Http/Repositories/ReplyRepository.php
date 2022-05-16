<?php

namespace App\Http\Repositories;

use App\Models\Reply;

class ReplyRepository
{
    public function newReply($replyText,$comment,$commentId){
        $reply =  Reply::create([
            'reply' =>$replyText,
            'comment_id' =>$commentId,
            'user_id' => auth()->id()
        ]);
        $comment->reply()->save($reply);
    }
}

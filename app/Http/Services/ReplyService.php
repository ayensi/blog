<?php

namespace App\Http\Services;

use App\Http\Contracts\IReplyService;
use App\Http\Repositories\ReplyRepository;

class ReplyService implements IReplyService
{
    private $replyRepository;

    public function __construct(ReplyRepository $replyRepository)
    {
        $this->replyRepository = $replyRepository;
    }

    public function newReply($reply, $comment,$commentId)
    {
        $this->replyRepository->newReply($reply,$comment,$commentId);
    }
}

<?php

namespace App\Http\Contracts;

interface IReplyService
{
    public function newReply($reply,$comment,$commentId);
}

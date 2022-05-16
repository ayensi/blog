<?php

namespace App\Http\Contracts;

interface ICommentService
{
    public function findByIdWithRating($id);
    public function findById($id);
    public function likeComment($id,$article);
    public function newComment($comment, $articleId);
    public function all();
    public function destroy($id);
}

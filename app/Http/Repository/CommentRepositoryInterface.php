<?php

namespace App\Http\Repository;

use App\Models\Article;
use App\Models\Comment;

interface CommentRepositoryInterface
{
    public function createComment(array $data);
    public function deleteComment(Comment $comment);
}

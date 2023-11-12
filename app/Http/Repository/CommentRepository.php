<?php
namespace App\Http\Repository;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CommentRepositoryInterface
{
    public function createComment(array $data)
    {
        $comment = new Comment();
        $comment->article_id = $data['article_id'];
        $comment->user_id = Auth::user()->id; // Assuming you are storing the user who created the comment
        $comment->content = $data['content'];
        $comment->save();

        return $comment;
    }

    public function deleteComment(Comment $comment)
    {
        if ($comment->user_id !== Auth::user()->id) {
            return false; // You can return a status or throw an exception
        }

        $comment->delete();

        return true; // You can return a status or throw an exception
    }
}

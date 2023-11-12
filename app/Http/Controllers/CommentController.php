<?php
namespace App\Http\Controllers;

use App\Http\Repository\CommentRepositoryInterface;
use App\Http\Requests\CommentRequestCreate;
use App\Http\Requests\CommentRequestDelete;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(CommentRequestCreate $request, $article)
    {
        // Validate the request data if needed
        $data = [
            'article_id' => $article,
            'content' => $request->content,
        ];
        $comment = $this->commentRepository->createComment($data);

        return back()->with('success', 'Comment added successfully');
    }

    public function destroy(CommentRequestDelete $commentReq, $comment)
    {

        $comment = Comment::find($comment);

        if (!$comment) {
            return back()->with('error', 'Comment not found');
        }

        $result = $this->commentRepository->deleteComment($comment);

        if (!$result) {
            return back()->with('error', 'There are Error');
        }

        return back()->with('success', 'Comment deleted successfully');
    }
}

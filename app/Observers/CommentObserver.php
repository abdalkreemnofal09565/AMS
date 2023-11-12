<?php

namespace App\Observers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Cache;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function Saved(Comment $comment)
    {
        $articles = Cache::get('articles'); // Replace 'article_key' with the actual key you used to cache the article
        if($articles[$comment['article_id']]){
            $articles[$comment['article_id']] = Article::find($comment['article_id']);
            Cache::forget('articles');

            Cache::put('articles', $articles, now()->addMinutes(5));

        }
    }

    /**
     * Handle the Comment "deleted" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {
        $articles = Cache::get('articles'); // Replace 'article_key' with the actual key you used to cache the article
        if($articles[$comment['article_id']]){
            $articles[$comment['article_id']] = Article::find($comment['article_id']);
            Cache::forget('articles');

            Cache::put('articles', $articles, now()->addMinutes(5));

        }
    }

}

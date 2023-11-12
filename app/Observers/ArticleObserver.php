<?php

namespace App\Observers;

use App\Http\Requests\ArticleRequestCreate;
use App\Models\Article;
use App\Models\User;
use App\Notifications\NewArticleNotification;
use Illuminate\Support\Facades\Notification;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     *
     * @param  \App\Models\Article  $article
     * @return void
     */
    public function creating(Article  $article)
    {
//        // Notify administrators when a new article is created
//        $adminUsers = User::admins()->get();
//
//        if ($adminUsers->isNotEmpty()) {
//            foreach ($adminUsers as $adminUser) {
//                Notification::send($adminUser, new NewArticleNotification($article));
//            }
//        }
    }
}

<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\NewArticleNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendNewArticleNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $article;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($article)
    {
        $this->article = $article;
    }

    public function handle()
    {
        // Send the new article notification to administrators
        Notification::send($this->getAdmins(), new NewArticleNotification($this->article));
    }

    protected function getAdmins()
    {
        // Logic to retrieve the administrators (users or recipients) who should receive the notification
        return User::admins()->get();
    }
}

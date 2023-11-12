<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewArticleNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var array $article
     */
    protected $article;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($article)
    {
        $this->article = $article;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        try {
            return (new MailMessage)
                ->subject('New Article Awaiting Review')
                ->greeting('Hello Admin,')
                ->line($this->article->brief_content)
                ->action('Review Article', url('articles.show', ['id' => $this->article->id]))
                ->line('Thank you for your attention.');
        } catch (\Exception $e) {
            // Log or report the exception
            \Log::error("Notification failed: " . $e->getMessage());
        }
    }


    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }


}

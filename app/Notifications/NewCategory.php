<?php

namespace App\Notifications;

use App\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCategory extends Notification implements ShouldQueue
{
    use Queueable;

    public $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)->view(
            'mails.category', ['category' => $this->category]
        );
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

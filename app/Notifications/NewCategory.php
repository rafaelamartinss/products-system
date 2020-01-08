<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewCategory extends Notification
{
    use Queueable;
    public $category;

    public function __construct($category)
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

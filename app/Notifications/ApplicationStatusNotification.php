<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationStatusNotification extends Notification
{
    use Queueable;

    public $status;
    public $program;
    public $comments;

    public function __construct($status, $program, $comments = null)
    {
        $this->status = ucfirst(str_replace('_', ' ', $status));
        $this->program = $program;
        $this->comments = $comments;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Application {$this->status}")
            ->greeting("Hello {$notifiable->name},")
            ->line("Your application for {$this->program} has been updated to:")
            ->line("Status: **{$this->status}**")
            ->line("Comments: " . ($this->comments ?: "None"))
            ->line("Thank you for using the UG Admission System!");
    }

    public function toArray($notifiable)
    {
        return [
            'title' => "Application {$this->status}",
            'message' => "Your application for {$this->program} has been {$this->status}.",
            'comments' => $this->comments,
            'program' => $this->program,
            'status' => $this->status
        ];
    }
}

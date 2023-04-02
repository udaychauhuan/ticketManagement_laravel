<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TicketSoldNotification extends Notification 
{
    use Queueable;
    public $ticket;
    public $user ; 
    /**
     * Create a new notification instance.
     */
    public function __construct($user,$ticket)
    {
        $this->user=$user;
        $this->ticket=$ticket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
           'userName' => $this->user->name,
           'ticketName' => $this->ticket->TicketName,
        ];
    }
}

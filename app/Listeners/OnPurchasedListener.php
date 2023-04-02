<?php

namespace App\Listeners;

use App\Events\TicketPurchasedEvent;
use App\Mail\purchasedMail;
use App\Models\AddTocart;
use App\Models\purchased;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OnPurchasedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(TicketPurchasedEvent $event): void
    {

        //for sending mail find the user and ticket details
        $user = User::find($event->UserId);
        $ticket = purchased::find($event->TicketId);
        
        //send mail using mail facade
        Mail::to($user->email)->send(new purchasedMail($user, $ticket));
    }
}

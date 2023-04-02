<?php

namespace App\Listeners;

use App\Events\RegisterUserEvent;
use App\Mail\welcomeMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OnRegisterSentMailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RegisterUserEvent $event): void
    {
        $user = User::find($event->userId);
        
         Mail::to($user->email)->send(new welcomeMail($user ,$event->password));
    }
}

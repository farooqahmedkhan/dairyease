<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\UserVerificationCode;

class UserRegistered
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
    public function handle(Registered $event): void
    {
        \Log::debug("Listener hit for user registered");
        \Log::debug($event->user);
        if($event->user->isCustomer() || $event->user->isProvider()){
            $event->user->notify(new UserVerificationCode(rand(0, 9999999)));
        }
    }
}

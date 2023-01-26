<?php

namespace App\Listeners;

use App\Events\ChirpCreated;
use App\Models\User;
use App\Notifications\NewChirp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

//[17] Implementamos en la funcion "ShouldQueue"
class SendChirpCreatedNotifications implements ShouldQueue
{
 
    public function __construct()
    {
        //
    }
 
    public function handle(ChirpCreated $event)
    {
        //[17] Realiza la comprobacion cada que ocurra un evento -> EventServiceProvider.php
        foreach (User::whereNot('id', $event->chirp->user_id)->cursor() as $user) {
            $user->notify(new NewChirp($event->chirp));
        }
    }
}

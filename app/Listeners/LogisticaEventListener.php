<?php

namespace App\Listeners;

use App\Events\LogisticaEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogisticaEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LogisticaEvent  $event
     * @return void
     */
    public function handle(LogisticaEvent $event)
    {
        //
    }
}

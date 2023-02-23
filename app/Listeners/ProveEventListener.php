<?php

namespace App\Listeners;

use App\Events\ProveEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProveEventListener
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
     * @param  \App\Events\ProveEvent  $event
     * @return void
     */
    public function handle(ProveEvent $event)
    {
        //
    }
}

<?php

namespace App\Listeners;

use App\Events\CallcenterEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CallcenterEventListener
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
     * @param  \App\Events\CallcenterEvent  $event
     * @return void
     */
    public function handle(CallcenterEvent $event)
    {
        //
    }
}

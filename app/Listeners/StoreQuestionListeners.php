<?php

namespace App\Listeners;

use App\Events\StoreQuestionEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreQuestionListeners
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
     * @param  object  $event
     * @return void
     */
    public function handle(StoreQuestionEvent $event)
    {
//        dd ($event->question);
//
//        exit();
    }
}

<?php

namespace App\Listeners;

use Illuminate\Routing\Events;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminEventSubscriber
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

    public function onRouteChanged($event)
    {
        //route
        $route = $event->route;

        
    }

    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Routing\Events\RouteMatched',
            'App\Listeners\AdminEventSubscriber@onRouteChanged'
        );
    }

    /**
     * Handle the event.
     *
     * @param  Events $event
     * @return void
     */
    public function handle(Events $event)
    {
        //
    }
}

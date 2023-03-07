<?php

namespace App\Listeners;

use App\Events\UserWeatherUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserWeatherUpdatedListener
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
    public function handle(UserWeatherUpdated $event): void
    {
        //
    }
}

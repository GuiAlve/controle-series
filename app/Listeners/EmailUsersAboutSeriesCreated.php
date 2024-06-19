<?php

namespace App\Listeners;

use App\Events\SeriesCreated as SeriesCreatedEvent;
use App\Mail\SeriesCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EmailUsersAboutSeriesCreated implements ShouldQueue
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
    public function handle(SeriesCreatedEvent $event): void
    {
        $userList = User::all();
        foreach ($userList as $index => $user){

            $email = new SeriesCreated(
                $event->seriesName,
                $event->seriesId,
                $event->seasonsQty,
                $event->episodesPerSeason,
            );
            $when = now()->addSeconds($index * 5);
            Mail::to($user)->later($when, $email);
        }
    }
}

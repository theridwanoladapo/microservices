<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogUserCreated
{
    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $data = [
            'email' => $event->user->email,
            'firstName' => $event->user->firstName,
            'lastName' => $event->user->lastName,
        ];

        file_put_contents(storage_path('logs/user_created.log'), json_encode($data));
    }
}

<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Redis;
use Predis\Client;

class SendUserCreated
{
    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        dispatch(function () use ($event) {
            $data = [
                'email' => $event->user->email,
                'firstName' => $event->user->firstName,
                'lastName' => $event->user->lastName,
            ];

            $redis = new Client();
            $redis->publish('user-created', json_encode($data));
            // Redis::publish('user-created', json_encode($data));
        });

    }
}

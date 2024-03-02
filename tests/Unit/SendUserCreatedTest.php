<?php

namespace Tests\Unit;

use App\Events\UserCreated;
use App\Listeners\SendUserCreated;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class SendUserCreatedTest extends TestCase
{
    public function test_user_created_handle()
    {
        $listener = new SendUserCreated();
        $user = User::create([
            'email' => 'test@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]);
        $event = new UserCreated($user);

        $listener->handle($event);
        
        $this->assertEquals(
            json_encode(['email' => $user->email, 'firstName' => $user->firstName, 'lastName' => $user->lastName]),
            file_get_contents(storage_path('logs/user_created.log'))
        );
    }
}

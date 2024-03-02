<?php

namespace Tests\Feature;

use App\Events\UserCreated;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommunicationTest extends TestCase
{
    public function testCommunicationBetweenMicroservices()
    {
        $user = User::create([
            'email' => 'test@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]);

        event(new UserCreated($user));

        sleep(2);
        
        $this->assertFileExists(storage_path('logs/user_created.log'));
        $logData = json_decode(file_get_contents(storage_path('logs/user_created.log')), true);

        $this->assertEquals($user->email, $logData['email']);
        $this->assertEquals($user->firstName, $logData['firstName']);
        $this->assertEquals($user->lastName, $logData['lastName']);
    }
}

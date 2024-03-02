<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FlowTest extends DuskTestCase
{
    public function test_complete_flow()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost:8000/users/create')
                ->type('email', 'test@example.com')
                ->type('firstName', 'John')
                ->type('lastName', 'Doe')
                ->press('Submit')
                ->assertSee('User created successfully');

            // Wait for the event to be processed
            sleep(2);

            // Check if the data is logged in the Notifications microservice
            $this->assertFileExists(storage_path('logs/user_created.log'));
            $logData = json_decode(file_get_contents(storage_path('logs/user_created.log')), true);

            $this->assertEquals('test@example.com', $logData['email']);
            $this->assertEquals('John', $logData['firstName']);
            $this->assertEquals('Doe', $logData['lastName']);
        });
    }
}

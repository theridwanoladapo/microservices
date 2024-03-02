<?php

namespace Tests\Unit;

use App\Http\Controllers\UsersController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class UsersServiceTest extends TestCase
{
    public function test_user_creation()
    {
        $controller = new UsersController();
        $request = new Request([
            'email' => 'test@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]);

        $response = $controller->store($request);

        $this->assertEquals(200, $response->getStatusCode());
    }
}

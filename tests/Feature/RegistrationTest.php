<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_register()
    {
        $password = $this->faker->password;

        $payload = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $password,
            'password_confirmation' => $password,
            'grant_type' => 'password',
            'client_id' => '1',
            'client_secret' => 'BTvUzKBA62ewVS4dT30hJ2eS2TUwSlY0bweTaI0h',
        ];

        $headers = [];

        $response = $this->post('api/register', $payload, $headers);

        $this->assertDatabaseHas('users', [
            'email' => $payload['email']
        ]);
    }
}

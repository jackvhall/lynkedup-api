<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Support\Str;

class JobsMatchTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    protected $user, $accessToken, $clientRepository, $client;

    /**
     *
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->user = \App\User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $clientRepository = new ClientRepository();
        $this->client = $clientRepository->createPersonalAccessClient($this->user->id, 'Test Personal Access Client', 'http://example.com/callback');

        $this->clientRepository = $clientRepository;

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $this->client->id,
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ]);

        $this->accessToken = $this->user->createToken('authToken')->accessToken;

    }

    /**
     * Test that new jobs can be added.
     *
     * @return void
     */
    public function test_a_user_can_create_a_job()
    {
        $oauth_client = DB::table('oauth_clients')->find(1);

        Passport::actingAsClient($oauth_client);
        $this->actingAs($this->user);

        $data = [
            'title' => $this->faker->jobTitle,
            'organization' => $this->faker->company,
            'description' => $this->faker->sentence,
            'salary_start' => $this->faker->numberBetween(55000, 95000),
            'salary_end' => $this->faker->numberBetween(100000, 200000)
        ];

        $user = \App\User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->password
        ]);

        $headers = [
            'Authorization' => 'bearer ' . $this->accessToken
        ];

        $response = $this->post('/api/jobs', $data, $headers);

        $this->assertDatabaseHas('jobs', $data);
    }
}

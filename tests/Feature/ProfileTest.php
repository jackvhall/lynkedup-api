<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Profile;

class ProfileTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_a_user_has_a_profile()
    {
        $user = factory('App\User')->create();
        Profile::create(['user_id' => $user->id]);

        $this->assertInstanceOf('App\Profile', $user->profile);
    }
}

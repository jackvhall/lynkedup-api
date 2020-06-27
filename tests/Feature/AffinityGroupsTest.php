<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Group;
use App\User;

class AffinityGroupsTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_groups()
    {
        $group = Group::create([
           'name' =>  $this->faker->jobTitle,
            'description' => $this->faker->sentence,
            'image_url' => $this->faker->url
        ]);

        $this->assertInstanceOf('App\Group', $group);
    }

    /** @test */
    public function a_user_can_join_groups()
    {
        $user = $this->createUser();

        $group = Group::create([
            'name' =>  $this->faker->jobTitle,
            'description' => $this->faker->sentence,
            'image_url' => $this->faker->url
        ]);

        $user->groups()->save($group);

        $this->assertDatabaseHas('group_user', [
           'user_id' => $user->id,
           'group_id' => $group->id
        ]);

    }

    private function createUser()
    {
        return User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);
    }
}
